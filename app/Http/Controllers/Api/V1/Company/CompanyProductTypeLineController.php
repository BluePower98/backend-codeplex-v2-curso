<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Api\ApiController;
use App\Models\Company;
use App\Models\ProductType;
use App\Services\Application\Line\LineService;
use Illuminate\Http\JsonResponse;

class CompanyProductTypeLineController extends ApiController
{
    private LineService $lineService;

    public function __construct(
        LineService $lineService
    )
    {
        $this->lineService = $lineService;
    }

    /**
     * @param Company $company
     * @param ProductType $productType
     * @return JsonResponse
     */
    public function index(Company $company, ProductType $productType): JsonResponse
    {
        $results = $this->lineService->findAllByCompanyAndProductType($company->idempresa, $productType->idtipoproducto);

        return $this->successResponse($results);
    }
}
