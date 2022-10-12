<?php

namespace App\Http\Controllers\Api\V1\Module;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use App\Services\Application\Module\ModuleService;
use App\Models\User;

class ModuleController extends ApiController
{
    private ModuleService $moduleservice;

    public function __construct(ModuleService $moduleservice)
    {
        $this->moduleservice=$moduleservice;

    }

    public function index(): JsonResponse
    {
        return $this->showMessage('ModuleController - index action');
    }

    public function findModuleByUserId(User $user):JsonResponse
    {
        $result=$this->moduleservice->findAllByUserId($user);

        return $this->successResponse($result);
    }
    public function findByPrefijoModulo(int $idplan)
    {
        $result=$this->moduleservice->findByPrefijoModulo($idplan);
        return $this->successResponse($result);
    }
}
