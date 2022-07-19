<?php

namespace App\Http\Controllers\Api\V1\Year;

use App\Http\Controllers\Api\ApiController;
use App\Services\Application\Year\YearService;
use Illuminate\Http\JsonResponse;

class YearController extends ApiController
{
    private YearService $yearService;

    public function __construct(
        YearService $yearService
    ) {
        $this->yearService = $yearService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $results = $this->yearService->findAll();

        return $this->successResponse($results);
    }
}
