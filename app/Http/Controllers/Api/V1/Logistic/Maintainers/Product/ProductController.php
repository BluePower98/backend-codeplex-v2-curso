<?php

namespace App\Http\Controllers\Api\V1\Logistic\Maintainers\Product;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductDeleteRequest;
use App\Http\Requests\Product\ProductGenerateCodeRequest;
use App\Services\Application\Product\ProductService;
use App\Services\Application\Product\ProductSaveService;

class ProductController extends ApiController
{
    private ProductService $productService;
    private ProductSaveService $productSaveService;

    public function __construct(
        ProductService     $productService,
        ProductSaveService $productSaveService,
    )
    {
        $this->productService = $productService;
        $this->productSaveService = $productSaveService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $results = $this->productService->findAll($request);

        return $this->successResponse($results);
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function show(Product $product, Request $request): JsonResponse
    {
        $result = $this->productService->show($product->{$product->getKeyName()}, $request->get("idempresa"));

        return $this->successResponse($result);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function datatables(Request $request): JsonResponse
    {
        $results = $this->productService->datatables($request);

        return $this->datatablesResponse($results);
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $this->productSaveService->store($request);

        return $this->showMessage("Producto registrado", Response::HTTP_CREATED);
    }

    /**
     * @param ProductGenerateCodeRequest $request
     * @return JsonResponse
     */
    public function generateCode(ProductGenerateCodeRequest $request): JsonResponse
    {
        $result = $this->productService->generateCode($request->all());

        return $this->successResponse(['code' => $result]);
    }

    /**
     * @param Product $product
     * @param ProductDeleteRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Product $product, ProductDeleteRequest $request): JsonResponse
    {
        $this->productService->delete($product->{$product->getKeyName()}, $request->get("idempresa"));

        return $this->showMessage("El producto seleccionado se ha eliminado correctamente.", Response::HTTP_NO_CONTENT);
    }
}
