<?php

namespace App\Repositories\ModuleCourse\CourseDetails;

use App\Models\CourseDetails;
use App\Repositories\BaseRepository;
use App\Repositories\ModuleCourse\CourseDetails\Builders\CourseDetailsDatatablesQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CourseDetailsRepository extends BaseRepository implements CourseDetailsRepositoryInterface

{
    public function __construct(CourseDetails $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $results = (new CourseDetailsDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }
    
    public function store(array $params): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_cursos_detalles ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?',
            ['M01',$params['idempresa'],
            isset($params['iddetallecurso'])?$params['iddetallecurso']:'',
            $params['idcurso'],
            $params['idespecialidad'],
            $params['idinstructor'],
            $params['detalledecurso'],
            $params['lección'],
            $params['cuestionarios'],
            $params['estudiantes'],
            $params['duración'],
            $params['certificado'],
            $params['whassap'],
            $params['fotos'],
            $params['activo'],]        
        );

        return collect($result);
    }

    public function update(array $params, string $idempresa, int $iddetallecurso): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_cursos_detalles ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?',
        ['M02', $idempresa,$iddetallecurso,
        $params['idcurso'],
        $params['idespecialidad'],
        $params['idinstructor'],
        $params['detalledecurso'],
        $params['lección'],
        $params['cuestionarios'],
        $params['estudiantes'],
        $params['duración'],
        $params['certificado'],
        $params['whassap'],
        $params['fotos'],
        $params['activo'],]         
    );

    return collect($result);
    }    

    public function delete(string $idempresa, int $iddetallecurso): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_cursos_detalles ?,?,?',
        ['M03', $idempresa,$iddetallecurso]        
    );

        return collect($result);    
    }

    public function show(string $idempresa, int $iddetallecurso): Collection
    {
       
        $result= DB::select('EXEC Mo_Man_cur_cursos_detalles ?,?,?',
        ['S02', $idempresa,$iddetallecurso]        
    );

        return collect($result);    
    }

    public function getCursos(string $idempresa): Collection
    {
      $result= DB::select('EXEC Mo_Man_cur_cursos_detalles ?,?',
      ['CB1', $idempresa]
      );

      return collect($result);
    }

    public function getEspecialidades(string $idempresa, int $idespecialidad): Collection
    {
      $result= DB::select('EXEC Mo_Man_cur_cursos_detalles ?,?',
      ['CB2', $idempresa]
      );

      return collect($result);
    }
}