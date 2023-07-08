<?php

namespace App\Repositories\ModuleCourse\Instructors;

use App\Models\Instructors;
use App\Repositories\BaseRepository;
use App\Repositories\ModuleCourse\Instructors\Builders\InstructorsDatatablesQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class InstructorsRepository extends BaseRepository implements InstructorsRepositoryInterface
{
    public function __construct(Instructors $model)
    {
        parent::__construct($model);
    }

    public function datatables(Request $request): Collection
    {
        $results = (new InstructorsDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }

    public function store(array $params): Collection
    {

        $result= DB::statement('EXEC Mo_Man_cur_instructores ?,?,?,?,?,?,?,?',
            ['M01',$params['idempresa'],
            isset($params['idinstructor'])?$params['idinstructor']:'',
            $params['apellidos'],
            $params['nombres'],
            $params['foto'],
            $params['detalle'],
            $params['activo']]
        );

        return collect($result);
    }

    public function update(array $params, string $idempresa, int $idinstructor): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_instructores ?,?,?,?,?,?,?,?',
        ['M02', $idempresa,$idinstructor,
        $params['apellidos'],
        $params['nombres'],
        $params['foto'],
        $params['detalle'],
        $params['activo']]
    );

    return collect($result);
    }

    public function delete(string $idempresa, int $idinstructor): Collection
    {
        $result= DB::statement('EXEC Mo_Man_cur_instructores ?,?,?',
        ['M03', $idempresa,$idinstructor]
    );

        return collect($result);
    }

    public function show(string $idempresa, int $idinstructor): Collection
    {

        $result= DB::select('EXEC Mo_Man_cur_instructores ?,?,?',
        ['S02', $idempresa,$idinstructor]
    );

        return collect($result);
    }

}
