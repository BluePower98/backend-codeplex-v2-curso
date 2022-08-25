<?php

namespace App\Services\Application\Product;

use App\Helpers\FileHelper;
use App\Repositories\ProductImage\ProductImageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductSaveService
{
    private ProductRepositoryInterface $productRepository;
    private ProductImageRepositoryInterface $productImageRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductImageRepositoryInterface $productImageRepository,
    )
    {
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
        DB::transaction(function() use ($request) {
            $product = $this->productRepository->store($request->all());

            if ($request->has("itemPrecios")) {

                // Procesar línea de precios
                $prices = json_decode($request->get("itemPrecios"), true) ?: [];

                $prices = array_map(function($price) use ($product) {
                    return array_merge($price, [
                        "idempresa" => $product->idempresa,
                        "idproducto" => $product->idproducto,
                    ]);
                }, $prices);

                $this->saveProductPricesLine($prices);
            }

            // Procesar imágenes del producto.
            $images = $request->only(['imagen1', 'imagen2', 'imagen3', 'imagen4']);

            $this->saveProductImages($request, $images, $product->idproducto, $product->idempresa);
        });
    }

    /**
     * Procesar línea de precios de un producto
     *
     * @param array $prices
     * @return void
     */
    private function saveProductPricesLine(array $prices): void
    {
        foreach ($prices as $price) {

            DB::select(
                'Exec Lo_Man_lo_zonasprecios ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?',
                [
                    'M01',
                    $price["idempresa"],
                    $price["idproducto"],
                    null,
                    $price['idzona'] ?? null,
                    $price['idmedida'] ?? null,
                    $price['idtipoprecio'] ?? null,
                    $price['codigoBarra'] ?? null,
                    $price['precioVenta'] ?? null,
                    $price['cantidadMinVen'] ?? null,
                    $price['incluidoIgv'] ?? null,
                    $price['defecto'] ?? null,
                    null,
                    $price['peso_kg'] ?? null,
                    $price['idpropiedad1'] ?? null,
                    $price['idpropiedad2'] ?? null,
                    $price['idpropiedad3'] ?? null,
                    $price['costo'] ?? null,
                    $price['utilidad_porcen'] ?? null,
                    $price['precio_minimo'] ?? null,
                ]
            );
        }
    }


    /**
     * Procesar imágenes de un producto.
     *
     * @param Request $request
     * @param array $images
     * @param int $productId
     * @param string $companyId
     * @return void
     */
    private function saveProductImages(Request $request, array $images, int $productId, string $companyId): void
    {
        $images = array_keys($images);

        $uploadPath = $request->get('upload_path') . $productId . '/';

        FileHelper::removeByUrl($uploadPath);

        $this->productImageRepository->deleteByCriteria([
            'idempresa' => $companyId,
            'idproducto' => $productId,
        ]);

        foreach ($images as $value) {
            if (!$request->hasFile($value)) {
                continue;
            }

            $file = $request->file($value);

            $fileName = FileHelper::sanitizerFileName($file->getClientOriginalName());
            $fileName = $fileName . '.' . $file->getClientOriginalExtension();

            $file->move($uploadPath, $fileName);

            $url = $uploadPath . $fileName;

            $this->productImageRepository->store([
                'idempresa' => $companyId,
                'idproducto' => $productId,
                'imagen' => $url,
            ]);
        }
    }

}
