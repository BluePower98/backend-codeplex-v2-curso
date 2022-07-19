<?php

namespace App\Http\Controllers\Api\V1\ZonePriceType;

use App\Http\Controllers\Api\ApiController;
use App\Services\Application\ZonePriceType\ZonePriceTypeService;
use Illuminate\Http\JsonResponse;

class ZonePriceTypeController extends ApiController
{
    private ZonePriceTypeService $zonePriceTypeService;

    public function __construct(
        ZonePriceTypeService $zonePriceTypeService
    )
    {
        $this->zonePriceTypeService = $zonePriceTypeService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $results = $this->zonePriceTypeService->findAll();

        return $this->successResponse($results);
    }
}
