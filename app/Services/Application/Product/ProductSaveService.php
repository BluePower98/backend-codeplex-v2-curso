<?php

namespace App\Services\Application\Product;

use App\Helpers\FileHelper;
use App\Models\Product;
use App\Repositories\ProductImage\ProductImageRepositoryInterface;
use App\Repositories\ZonePrice\ZonePriceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Facades\Schema;

class ProductSaveService
{
    private ProductRepositoryInterface $productRepository;
    private ProductImageRepositoryInterface $productImageRepository;
    private ZonePriceRepositoryInterface $zonePriceRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductImageRepositoryInterface $productImageRepository,
        ZonePriceRepositoryInterface $zonePriceRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;
        $this->zonePriceRepository = $zonePriceRepository;
    }

    /**
     * Crear producto.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
        DB::transaction(function() use ($request) {
            $product = $this->productRepository->store($request->all());

            $this->saveImagesAndProductPricesLine($product, $request);
        });
    }

    /**
     * Actualizar producto.
     *
     * @param Product $product
     * @param Request $request
     * @return void
     */
    public function update(Product $product, Request $request): void
    {
        DB::transaction(function() use ($request, $product) {
            $columns = Schema::getColumnListing($product->getTable());

            $productId = $product->{$product->getKeyName()};

            $this->productRepository->update($productId, $request->only($columns));

            $product = $this->productRepository->findOneOrFailByCriteria([
                "idproducto" => $productId,
                "idempresa" => $request->get('idempresa')
            ]);

            $this->saveImagesAndProductPricesLine($product, $request);
        });
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return void
     */
    private function saveImagesAndProductPricesLine(Product $product, Request $request): void
    {
        $productId = $product->idproducto;
        $companyId = $product->idempresa;

        if ($request->has("itemPrecios")) {

            // Procesar línea de precios
            $prices = json_decode($request->get("itemPrecios"), true) ?: [];

            $this->zonePriceRepository->delete($productId, $companyId);

            foreach ($prices as $price) {

                $price['idempresa'] = $companyId;
                $price['idproducto'] = $productId;

                $this->zonePriceRepository->store($price);
            }
        }

        // Procesar imágenes del producto.
        $images = $request->only(['imagen1', 'imagen2', 'imagen3', 'imagen4']);

        $this->saveProductImages($request, $images, $productId, $companyId);
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
