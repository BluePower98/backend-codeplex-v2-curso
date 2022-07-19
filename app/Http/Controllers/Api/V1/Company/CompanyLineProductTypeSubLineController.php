<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Api\ApiController;
use App\Models\Company;
use App\Models\Line;
use App\Models\ProductType;
use App\Services\Application\SubLine\SubLineService;
use Illuminate\Http\JsonResponse;

class CompanyLineProductTypeSubLineController extends ApiController
{
    private SubLineService $subLineService;

    public function __construct(SubLineService $subLineService)
    {
        $this->subLineService = $subLineService;
    }

    /**
     * @param Company $company
     * @param Line $line
     * @param ProductType $productType
     * @return JsonResponse
     */
    public function index(Company $company, Line $line, ProductType $productType): JsonResponse
    {
        $results = $this->subLineService->findAllByCompanyAndLineAndProductType(
            $company->idempresa,
            $line->idlinea,
            $productType->idtipoproducto
        );

        return $this->successResponse($results);
    }
}
