<?php

namespace App\Http\Controllers\Api\V1\Plan;

use App\Http\Controllers\Api\ApiController;
use App\Services\Application\Plan\PlanService;
use Illuminate\Http\JsonResponse;

class PlanController extends ApiController
{
    private PlanService $planService;

    public function __construct(
        PlanService $planService
    )
    {
        $this->planService = $planService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $results = $this->planService->findAll();

        return $this->successResponse($results);
    }
}
