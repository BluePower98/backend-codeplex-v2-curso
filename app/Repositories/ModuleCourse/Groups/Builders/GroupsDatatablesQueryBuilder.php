<?php

namespace App\Repositories\ModuleCourse\Groups\Builders;

use Exception;
use App\Models\Groups;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GroupsDatatablesQueryBuilder
{
    private Groups $model;
    private Request $request;
    private Builder $query;

    public function __construct(Groups $model, Request $request)
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
        ->make(true)
        ->getData();
    }

    private function settingQueryBuilder(): void {
        $this->query = DB::table("{$this->model->getTable()} AS T1")
            ->select([
                DB::raw("T1.idempresa"),
                DB::raw("ISNULL(T1.idgrupo,'')  AS idgrupo"),
                DB::raw("ISNULL(T1.idcurso,'') AS idcurso"),
                DB::raw("ISNULL(T1.nombre,'') AS nombre"),
                DB::raw("ISNULL(T1.fecha_inicio,'')  AS fecha_inicio"),
                DB::raw("ISNULL(T1.fecha_fin,'')  AS fecha_fin"),
                DB::raw("ISNULL(T1.duracion,'')  AS duracion"),
                DB::raw("ISNULL(T1.beneficios,'')  AS beneficios"),
                DB::raw("ISNULL(T1.costo,'')  AS costo"),
                DB::raw("ISNULL(T1.idmoneda,'')  AS idmoneda"),
                DB::raw("ISNULL(T1.activo,'')  AS activo"),

            ])
            ->Join('cur_monedas AS Z',function(JoinClause $join){
                $join->on('Z.idmoneda','=','T1.idmoneda');
            });
            $this->addFilters();
     }

     private function addFilters(): void {
        if ($idempresa = $this->request->get('idempresa')) {
            $this->query = $this->query->where('T1.idempresa', $idempresa)
            ->where('T1.idmoneda', 1);
        }       
     }
}