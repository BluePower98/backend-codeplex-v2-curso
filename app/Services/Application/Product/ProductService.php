<?php

namespace App\Services\Application\Product;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductShowResource;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductImage\ProductImageRepositoryInterface;
use App\Repositories\ZonePrice\ZonePriceRepositoryInterface;

class ProductService
{
    private ProductRepositoryInterface $productRepository;
    private ZonePriceRepositoryInterface $zonePriceRepository;
    private InventoryRepositoryInterface $inventoryRepository;
    private ProductImageRepositoryInterface $productImageRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ZonePriceRepositoryInterface $zonePriceRepository,
        InventoryRepositoryInterface $inventoryRepository,
        ProductImageRepositoryInterface $productImageRepository,
    )
    {
        $this->productRepository = $productRepository;
        $this->zonePriceRepository = $zonePriceRepository;
        $this->inventoryRepository = $inventoryRepository;
        $this->productImageRepository = $productImageRepository;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function findAll(Request $request): Collection
    {
        $results = $this->productRepository->findAll($request);

        return ProductResource::collection($results)->collection;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function datatables(Request $request): Collection
    {
        return $this->productRepository->datatables($request);
    }

    /**
     * @param int $productId
     * @param string $companyId
     * @return ProductShowResource
     */
    public function show(int $productId, string $companyId): ProductShowResource
    {
        $product = $this->productRepository->findOneOrFailByCriteria(["idproducto" => $productId, "idempresa" => $companyId]);

        // Obtener información de las imágenes de un producto
        $product->images = $this->productImageRepository->findByCriteria([
            'idempresa' => $companyId,
            'idproducto' => $productId,
        ]);

        return new ProductShowResource($product);
    }

    /**
     * @param array $params
     * @return int
     */
    public function generateCode(array $params): int
    {
        return $this->productRepository->generateCode($params['idempresa'], $params['idtipoproducto']);
    }

    /**
     * @param int $productId
     * @param string $companyId
     * @return void
     * @throws Exception
     */
    public function delete(int $productId, string $companyId): void
    {
        $this->productRepository->findOneOrFailByCriteria(["idproducto" => $productId, "idempresa" => $companyId]);

        DB::beginTransaction();

        try {
            $this->inventoryRepository->delete($productId, $companyId);
            $this->zonePriceRepository->delete($productId, $companyId);
            $this->productRepository->delete($productId, $companyId);

            // Eliminar los ficheros del producto
            $company = explode("-", $companyId);

            $dir = 'empresas_profile/' . trim($company[1]) . '/Logistica.Net/ProductosForm/' . $productId;

            if (is_dir($dir)) {
                $files = array_diff(scandir($dir), array('.', '..'));
                foreach ($files as $file) {
                    (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
                }
                rmdir($dir);
            }

            DB::commit();

        } catch (Exception $exc) {
            DB::rollBack();

            if (
                strpos($exc->getMessage(), "Integrity constraint violation") ||
                strpos($exc->getMessage(), "The DELETE statement conflicted with the REFERENCE constraint")
            ) {
                throw new Exception(
                    "No se puede eliminar el producto seleccinado.",
                    Response::HTTP_BAD_REQUEST
                );
            }

            throw $exc;
        }

    }
}
