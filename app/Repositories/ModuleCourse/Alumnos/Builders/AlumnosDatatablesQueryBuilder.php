<?php

namespace App\Repositories\ModuleCourse\Alumnos\Builders;

use App\Models\Alumnos;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AlumnosDatatablesQueryBuilder
{
    private Alumnos $model;
    private Request $request;
    private Builder $query;

    public function __construct(Alumnos $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

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
            DB::raw("ISNULL(T1.idalumno, '') AS idalumno"),
            DB::raw("ISNULL(T1.rucdni, '') AS rucdni"),
            DB::raw("ISNULL(T1.nombres, '') AS nombres"),
            DB::raw("ISNULL(T1.apellidos, '') AS apellidos"),
            DB::raw("ISNULL(CONVERT(VARCHAR,T1.fecha_registro,23),'')  AS fecha_registro"),
            DB::raw("ISNULL(T1.activo, '') AS activo")
        ]);

        $this->addFilters();
        
    }

    private function addFilters(): void
    {
        if ($idempresa = $this->request->get('idempresa')) {
            $this->query = $this->query->where('T1.idempresa', $idempresa);
        }
    }
}