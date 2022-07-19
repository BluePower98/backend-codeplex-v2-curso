<?php

namespace App\Http\Controllers\Api\V1\Module;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;

class ModuleController extends ApiController
{
    public function __construct()
    {
    }

    public function index(): JsonResponse
    {
        return $this->showMessage('ModuleController - index action');
    }
}
