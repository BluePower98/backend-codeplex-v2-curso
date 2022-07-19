<?php

namespace App\Http\Controllers\Api\V1\Module;

use App\Http\Controllers\Api\ApiController;
use App\Models\Module;
use App\Models\Plan;
use App\Services\Application\Menu\MenuService;
use Illuminate\Http\JsonResponse;

class ModulePlanMenuController extends ApiController
{
    private MenuService $menuService;

    public function __construct(
        MenuService $menuService
    )
    {
        $this->menuService = $menuService;
    }

    public function index(Module $module, Plan $plan): JsonResponse
    {
        $results = $this->menuService->findAllByModuleIdAndPlanId($module->getKey(), $plan->getKey());

        return $this->successResponse($results);
    }
}
