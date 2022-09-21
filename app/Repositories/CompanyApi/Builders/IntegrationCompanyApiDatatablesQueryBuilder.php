<?php
namespace App\Repositories\CompanyApi\Builders;

use App\Models\Company;
use App\Models\Plan;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class IntegrationCompanyApiDatatablesQueryBuilder
{
    private Company $company;
    private Builder $query;
    private Plan $model;

    public function __construct(Plan $model,Company $company,string $userId,Request $request)
    {
        
        $this->company=$company;
        $this->userId=$userId;
        $this->request=$request;
        $this->model=$model;
    }

    public function getData():mixed
    {
        
        $this->settingQueryBuilder();
       
        return Datatables::query($this->query)
        ->make(true)
        ->getData();
    }

    private function settingQueryBuilder():void
    {
        $this->query=DB::table("{$this->model->getTable()} AS p")
                    ->select([
                        DB::raw("e.idempresa AS idempresa"),
                        DB::raw("CASE WHEN e.ruc IS NULL THEN ' ' ELSE e.ruc END AS ruc"),
                        'e.nombrerazon',
                        DB::raw("ISNULL(lp.sol_usuario,' ') AS sol_usuario"),
                        DB::raw("CASE lp.Produccion WHEN NULL THEN '' WHEN 0 THEN 'BETA' WHEN 1 THEN 'ESTABLE' END AS entorno"),
                        "p.descripcion"
                    ])
                    ->Join('zg_usuariosplanesdet AS up',function(JoinClause $join){
                        $join->on('up.idplan','=','p.idplan');
                    })
                    ->join('zg_usuariossucursales AS us',function(JoinClause $join){
                        $join->on('us.idusuario','=','up.idusuario');
                    })
                    ->join('zg_empresas AS e',function(JoinClause $join){
                        $join->on('e.idempresa','=','us.idempresa');
                    })
                    ->leftJoin('lo_parametros AS lp',function(JoinClause $join){
                        $join->on('lp.idempresa','=','e.idempresa');
                    });
                    $this->addFilters();
    }

    private function addFilters():void
    {
        if($idususario=$this->userId){
            $this->query=$this->query->where('us.idusuario',$idususario);
        }
        if($idplan=$this->request->get('idplan')){
            $this->query=$this->query->where('p.idplan',$idplan)->DISTINCT();
        }
    }
}