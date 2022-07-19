<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use App\Services\Application\Branch\BranchService;

class CompanyUserBranchController extends ApiController
{
    private BranchService $branchService;

    public function __construct(
        BranchService $branchService
    )
    {
        $this->branchService = $branchService;
    }

    /**
     * @param Company $company
     * @param User $user
     * @return JsonResponse
     */
    public function index(Company $company, User $user): JsonResponse
    {
        $results = $this->branchService->findAllByCompanyAndUser($company->getKey(), $user->getKey());

        return $this->successResponse($results);
    }
}
