<?php

namespace App\Repositories\ModuleCourse\CourseDetails\Builders;

use Exception;
use App\Models\CourseDetails;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CourseDetailsDatatablesQueryBuilder
{
    private CourseDetails $model;
    private Request $request;
    private Builder $query;

    public function __construct(CourseDetails $model, Request $request)
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
                DB::raw("ISNULL(T1.iddetallecurso,'')  AS iddetallecurso"),
                DB::raw("ISNULL(T1.idcurso,'') AS idcurso"),
                DB::raw("ISNULL(T1.idespecialidad,'') AS idespecialidad"),
                DB::raw("ISNULL(T1.idinstructor,'')  AS idinstructor"),
                DB::raw("ISNULL(T1.detalledecurso,'')  AS detalledecurso"),
                DB::raw("ISNULL(T1.lección,'')  AS lección"),
                DB::raw("ISNULL(T1.cuestionarios,'')  AS cuestionarios"),
                DB::raw("ISNULL(T1.estudiantes,'')  AS estudiantes"),               
                DB::raw("ISNULL(a.descripcion,'')  AS descripcionescurso"),
                DB::raw("ISNULL(z.descripcion,'')  AS descripcionespecialidad"),
                DB::raw("ISNULL(n.apellidos,'')  AS apellidosintructor"),

            ])
            ->leftJoin('cur_especialidades AS Z',function(JoinClause $join){
                $join->on('Z.idespecialidad','=','T1.idespecialidad');
            })
            ->leftJoin('cur_cursos AS A',function(JoinClause $join){
                $join->on('A.idcurso','=','T1.idcurso');
            })
            ->leftJoin('cur_instructores AS N',function(JoinClause $join){
                $join->on('N.idinstructor','=','T1.idinstructor');
            });
            $this->addFilters();
     }
     private function addFilters(): void {
        if ($idempresa = $this->request->get('idempresa')) {
            $this->query = $this->query->where('T1.idempresa', $idempresa)
            ->where('T1.idespecialidad', 1)
            ->where('T1.idcurso', 1)
            ->where('T1.idinstructor', 1);
        }       
     }
}