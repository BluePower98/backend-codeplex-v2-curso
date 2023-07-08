<?php

namespace App\Repositories\ModuleCourse\Alumnos;

use App\Models\Alumnos;
use App\Repositories\BaseRepository;
use App\Repositories\ModuleCourse\Alumnos\Builders\AlumnosDatatablesQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AlumnosRepository extends BaseRepository implements AlumnosRepositoryInterface
{
    public function __construct(Alumnos $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $result = (new AlumnosDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($result);
    }

    public function store(array $params): Collection
    {

        $result= DB::statement('EXEC Mo_Man_cur_alumnos ?,?,?,?,?,?,?,?,?',
        ['M01',$params['idempresa'],
        isset($params['idalumno'])?$params['idalumno']:'',
        $params['rucdni'],
        $params['nombres'],
        $params['apellidos'],
        $params['foto'],
        $params['fecha_registro'],
        $params['activo']]

    );

    return collect($result);

    }

    public function update(array $params, string $idempresa, string $idalumno): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_alumnos ?,?,?,?,?,?,?,?,?',
        ['M02',$idempresa,$idalumno,
        $params['rucdni'],
        $params['nombres'],
        $params['apellidos'],
        $params['foto'],
        $params['fecha_registro'],
        $params['activo']]
    );

    return collect($result);

    }

    public function delete(string $idempresa, string $idalumno): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_alumnos ?,?,?',
        ['M03', $idempresa,$idalumno]
    );

        return collect($result);
    }

    public function show(string $idempresa, string $idalumno): Collection
    {
        $result= DB::select('EXEC Mo_Man_cur_alumnos ?,?,?',
        ['S02', $idempresa,$idalumno]
    );
        return collect($result);
    }

}
