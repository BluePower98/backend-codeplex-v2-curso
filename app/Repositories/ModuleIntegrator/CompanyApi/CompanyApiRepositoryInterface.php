<?php
namespace App\Repositories\ModuleIntegrator\CompanyApi;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

interface CompanyApiRepositoryInterface
{
    public function datatables(string $idusuario,Request $request):Collection;
}