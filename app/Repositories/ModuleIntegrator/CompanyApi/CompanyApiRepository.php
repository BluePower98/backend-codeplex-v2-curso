<?php

namespace App\Repositories\ModuleIntegrator\CompanyApi;

use App\Models\Company;
use App\Models\Plan;
use App\Repositories\ModuleIntegrator\CompanyApi\Builders\IntegrationCompanyApiDatatablesQueryBuilder;
use App\Repositories\ModuleIntegrator\CompanyApi\CompanyApiRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;


class CompanyApiRepository implements CompanyApiRepositoryInterface
{
    private Plan $model;
    private Company $company;

    public function __construct(Plan $model,Company $company)
    {
        $this->model = $model;
        $this->company=$company;
    } 
    public function datatables(string $idusuario,Request $request ): Collection
    {
        
        $result = (new IntegrationCompanyApiDatatablesQueryBuilder($this->model,$this->company,$idusuario, $request))->getData();
        // dd($result);
        return collect($result);
    }
}