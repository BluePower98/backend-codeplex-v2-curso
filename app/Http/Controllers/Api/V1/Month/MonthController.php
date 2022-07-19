<?php

namespace App\Http\Controllers\Api\V1\Month;

use App\Http\Controllers\Api\ApiController;
use App\Services\Application\Month\MonthService;
use Illuminate\Http\JsonResponse;

class MonthController extends ApiController
{
    private MonthService $monthService;

    public function __construct(
        MonthService $monthService
    )
    {
        $this->monthService = $monthService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $results = $this->monthService->findAll();

        return $this->successResponse($results);
    }
}
