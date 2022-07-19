<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Api\ApiController;
use App\Models\Company;
use App\Services\Application\Measure\MeasureService;
use Illuminate\Http\JsonResponse;

class CompanyMeasureController extends ApiController
{
    private MeasureService $measureService;

    public function __construct(
        MeasureService $measureService
    )
    {
        $this->measureService = $measureService;
    }


    /**
     * @param Company $company
     * @return JsonResponse
     */
    public function index(Company $company): JsonResponse
    {
        $results = $this->measureService->findAllByCompany($company->getKey());

        return $this->successResponse($results);
    }
}
