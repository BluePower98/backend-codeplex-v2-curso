<?php

namespace App\Repositories\Product\Builders;

use Exception;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductDatatablesQueryBuilder
{
    private Product $model;
    private Request $request;
    private Builder $query;

    public function __construct(Product $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }


    /**
     * @return mixed
     * @throws Exception
     */
    public function getData(): mixed
    {
        $this->settingQueryBuilder();

        return Datatables::query($this->query)
            ->filterColumn('T1.codigo', function(Builder $query, $keyword) {
                $query->where("T1.codigo", "LIKE" , "{$keyword}");
            })
            ->filterColumn('porpercepcion', function($query, $keyword) {
                $sql = "ISNULL(T1.porpercepcion, 0) LIKE ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('porisc', function($query, $keyword) {
                $sql = "ISNULL(T1.porisc,0) LIKE ?";

                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->make(true)
            ->getData();
    }

    /**
     * @return void
     */
    private function settingQueryBuilder(): void {
        $this->query = DB::table("{$this->model->getTable()} AS T1")
            ->select([
                DB::raw("ISNULL(T2.descripcion,'') AS Destipoproductos"),
                'T1.idempresa',
                'T1.idproducto',
                DB::raw("ISNULL(T1.idtipoproducto,0) AS idtipoproducto"),
                DB::raw("ISNULL(T1.idlinea,0) AS idlinea"),
                DB::raw("ISNULL(T3.descripcion,'') AS Deslineas"),
                DB::raw("ISNULL(T1.idlineasub,0) AS idlineasub"),
                DB::raw("ISNULL(T4.descripcion,'') AS Deslineassub"),
                DB::raw("ISNULL(T1.idsunatt07,0) AS idsunatt07"),
                DB::raw("ISNULL(T5.descripcion,'') AS Dessunatt07"),
                'T1.codigo',
                'T1.descripcion',
                'T1.activo',
                DB::raw("ISNULL(T1.infad1,'') AS infad1"),
                DB::raw("ISNULL(T1.infad2,'') AS infad2"),
                'T1.infad3',
                DB::raw("ISNULL(T1.porpercepcion,0) AS porpercepcion"),
                DB::raw("ISNULL(T1.porisc,0) AS porisc"),
                'T1.estadoventa',
                'T1.escombo'
            ])
            ->leftJoin('zg_tipoproductos AS T2', function(JoinClause $join){
                $join->on('T1.idtipoproducto', '=' ,'T2.idtipoproducto');
            })
            ->leftJoin('lo_lineas AS T3', function(JoinClause $join){
                $join->on('T1.idtipoproducto', '=' ,'T3.idtipoproducto');
                $join->on('T1.idlinea', '=' ,'T3.idlinea');
                $join->on('T1.idempresa', '=' ,'T3.idempresa');
            })
            ->leftJoin('lo_lineassub AS T4', function(JoinClause $join){
                $join->on('T1.idtipoproducto', '=' ,'T4.idtipoproducto');
                $join->on('T1.idlinea', '=' ,'T4.idlinea');
                $join->on('T1.idlineasub', '=' ,'T4.idlineasub');
                $join->on('T1.idempresa', '=' ,'T4.idempresa');
            })
            ->leftJoin('st_sunatt07_tipo_afectaciones AS T5', function(JoinClause $join){
                $join->on('T1.idsunatt07', '=' ,'T5.idsunatt07');
            });

        $this->addFilters();
    }

    /**
     * @return void
     */
    private function addFilters(): void {
        // Filters
        if ($companyId = $this->request->get('idempresa')) {
            $this->query = $this->query->where('T1.idempresa', $companyId);
        }

        if ($productTypeId = $this->request->get('idtipoproducto')) {
            $this->query = $this->query->where('T1.idtipoproducto', $productTypeId);
        }
    }
}
