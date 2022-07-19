<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Services\Application\Company\CompanyService;
use Illuminate\Http\JsonResponse;

class UserCompanyController extends ApiController
{

    private CompanyService $companyService;

    public function __construct(
        CompanyService $companyService
    )
    {
        $this->companyService = $companyService;
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function index(User $user): JsonResponse
    {


        $results = $this->companyService->findAllByUser($user->{$user->getKeyName()});

        return $this->successResponse($results);
    }

}
