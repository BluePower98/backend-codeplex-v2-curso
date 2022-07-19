<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Api\ApiController;
use App\Models\Company;
use App\Services\Application\Zone\ZoneService;
use Illuminate\Http\JsonResponse;

class CompanyZoneController extends ApiController
{
    private ZoneService $zoneService;

    public function __construct(
        ZoneService $zoneService
    )
    {
        $this->zoneService = $zoneService;
    }

    /**
     * @param Company $company
     * @return JsonResponse
     */
    public function index(Company $company): JsonResponse
    {
        $results = $this->zoneService->findAllByCompany($company->getKey());

        return $this->successResponse($results);
    }
}
