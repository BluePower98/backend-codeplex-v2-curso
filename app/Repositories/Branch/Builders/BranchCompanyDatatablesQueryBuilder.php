<?php
namespace App\Repositories\Branch\Builders;

use App\Models\Branch;
use Illuminate\Contracts\Database\Query\Builder;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;


class BranchCompanyDatatablesQueryBuilder
{
    private Branch $model;
    private Builder $query;
    public function __construct(Branch $model, string $companyId)
    {
        $this->model=$model;
        $this->companyId=$companyId;
    }

    public function getData():mixed
    {
            $this->settingQueryBuilder();

            return Datatables::query($this->query)
                ->make(true)->getData();
    }

    public function settingQueryBuilder():void
    {
        $this->query=DB::table("{$this->model->getTable()} AS B")
                ->select(['B.idempresa',
                        'B.idsucursal',
                        'B.codigo',
                        'B.idzona',
                        DB::raw("ISNULL(B.Descripcion,'') AS Deszonas"),
                        'B.descripcion',
                        DB::raw("CASE WHEN B.cuo IS NULL THEN '' ELSE B.cuo END As cuo"),
                        DB::raw("CASE WHEN B.direccion IS NULL THEN '' ELSE B.direccion END As direccion"),
                        DB::raw("CASE WHEN B.telefono IS NULL THEN '' ELSE B.telefono END As telefono"),
                        DB::raw("CASE WHEN B.email IS NULL THEN '' ELSE B.email END As email"),
                        'B.ubigeo','B.principal',
                        DB::raw("CASE WHEN B.responsable IS NULL THEN '' ELSE B.responsable END As responsable"),
                        'B.activo'

                    ])
                    ->leftJoin('lo_zonas AS Z',function(JoinClause $join){
                        $join->on('Z.IdZona','=','B.IdZona');
                        $join->on('Z.idempresa','=','B.idempresa');
                    });
                    $this->addFilters();
    }
    private function addFilters():void
    {
        if($idempresa=$this->companyId){
            $this->query=$this->query->where('B.idempresa','=',$idempresa);
        }
    }
}