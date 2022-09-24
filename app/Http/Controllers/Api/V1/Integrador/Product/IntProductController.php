<?php

namespace App\Http\Controllers\Api\V1\Integrador\Product;


use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Services\Application\Product\ProductService;

class IntProductController extends ApiController
{
    private ProductService $productService;

    public function __construct(
        ProductService     $productService
    )
    {
        $this->productService = $productService;
    }

    public function getProductListByComapanyId(string $companyId,string $prefijo):JsonResponse
    {
        $result=$this->productService->getProductListByComapanyId($companyId,$prefijo);
        return $this->successResponse($result);
    }
}