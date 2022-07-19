<?php

namespace App\Http\Controllers\Api\V1\Sunatt07TypeAffectation;

use App\Http\Controllers\Api\ApiController;
use App\Services\Application\Sunatt07TypeAffectation\Sunatt07TypeAffectationService;
use Illuminate\Http\JsonResponse;

class Sunatt07TypeAffectationController extends ApiController
{
    private Sunatt07TypeAffectationService $sunatt07TypeAffectationService;

    public function __construct(
        Sunatt07TypeAffectationService $sunatt07TypeAffectationService
    )
    {
        $this->sunatt07TypeAffectationService = $sunatt07TypeAffectationService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $results = $this->sunatt07TypeAffectationService->findAll();

        return $this->successResponse($results);
    }
}
