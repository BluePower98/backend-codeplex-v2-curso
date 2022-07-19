<?php

namespace App\Http\Controllers\Api\V1\Logistic\Maintainers\Product;

use App\Http\Controllers\Api\ApiController;
use App\Models\Company;
use App\Models\Product;
use App\Services\Application\ZonePrice\ZonePriceService;
use Illuminate\Http\JsonResponse;

class ProductCompanyZonePriceController extends ApiController
{
    private ZonePriceService $zonePriceService;

    public function __construct(
        ZonePriceService $zonePriceService
    )
    {
        $this->zonePriceService = $zonePriceService;
    }

    public function index(Product $product, Company $company): JsonResponse
    {
        $results = $this->zonePriceService->findAllByProductAndCompany(
            $product->idproducto,
            $company->idempresa,
        );

        return $this->successResponse($results);
    }
}
