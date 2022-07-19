<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Services\Application\Module\ModuleService;
use Illuminate\Http\JsonResponse;

class UserModuleController extends ApiController
{

    private ModuleService $moduleService;

    public function __construct(
        ModuleService $moduleService
    )
    {
        $this->moduleService = $moduleService;
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function index(User $user): JsonResponse
    {
        $results = $this->moduleService->findAllByUser($user);

        return $this->successResponse($results);
    }
}
