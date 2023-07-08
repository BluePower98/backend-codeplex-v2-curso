<?php

namespace App\Repositories\ModuleCourse\Courses;

use App\Models\Courses;
use App\Repositories\BaseRepository;
use App\Repositories\ModuleCourse\Courses\Builders\CoursesDatatablesQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    public function __construct(Courses $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $results = (new CoursesDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }

    public function store(array $params): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_cursos ?,?,?,?,?,?,?',
            ['M01',$params['idempresa'],
            isset($params['idcurso'])?$params['idcurso']:'',
            $params['idespecialidad'],
            $params['descripcion'],
            $params['portada'],
            $params['activo']]        
        );

        return collect($result);
    }

    public function update(array $params, string $idempresa, int $idcurso): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_cursos ?,?,?,?,?,?,?',
        ['M02', $idempresa,$idcurso,
        $params['idespecialidad'],
        $params['descripcion'],
        $params['portada'],
        $params['activo']]        
    );

    return collect($result);
    }   

    public function delete(string $idempresa, int $idcurso): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_cursos ?,?,?',
        ['M03', $idempresa,$idcurso]        
    );

        return collect($result);    
    }

    public function show(string $idempresa, int $idcurso): Collection
    {
       
        $result= DB::select('EXEC Mo_Man_cur_cursos ?,?,?',
        ['S02', $idempresa,$idcurso]        
    );

        return collect($result);    
    }

    public function getEspecialidades(string $idempresa): Collection
    {
      $result= DB::select('EXEC Mo_Man_cur_cursos ?,?',
      ['CB1', $idempresa]
      );

      return collect($result);
    }

}