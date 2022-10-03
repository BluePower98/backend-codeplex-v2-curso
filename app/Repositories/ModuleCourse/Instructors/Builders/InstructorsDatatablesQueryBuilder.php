<?php

namespace App\Repositories\ModuleCourse\Instructors\Builders;

use Exception;
use App\Models\Instructors;
use Illuminate\Database\Query\Builder; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InstructorsDatatablesQueryBuilder
{
    private Instructors $model;
    private Request $request;
    private Builder $query;

    public function __construct(Instructors $model, Request $request)
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
                //DB::raw("ISNULL(T1.foto,'') AS foto"),
                DB::raw("ISNULL(T1.idinstructor,'')  AS idinstructor"),
                DB::raw("ISNULL(T1.apellidos,'')  AS apellidos"),
                DB::raw("ISNULL(T1.nombres,'') AS nombres"),
                DB::raw("ISNULL(T1.detalle,'')  AS detalle"),
                DB::raw("ISNULL(T1.activo,'')  AS activo"),

            ]);
            $this->addFilters();
     }

     private function addFilters(): void {
        if ($idempresa = $this->request->get('idempresa')) {
            $this->query = $this->query->where('T1.idempresa', $idempresa);
        }       
     }
}