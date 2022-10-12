<?php

namespace App\Http\Controllers\Api\V1\ModuleIntegrator\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Services\Application\ModuleIntegrator\CompanyApi\CompanyApiService;

class CompanyApiController extends ApiController
{
    public  CompanyApiService $companyApiService;
    public function __construct(CompanyApiService $companyApiService)
    {
        $this->companyApiService=$companyApiService;
    }

    public function datatable(Request $request)
    {
        $result=$this->companyApiService->datatables($request);
        return $this->datatablesResponse($result);
    }
}
