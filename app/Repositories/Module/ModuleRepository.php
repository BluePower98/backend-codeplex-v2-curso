<?php

namespace App\Repositories\Module;

use App\Models\Module;
use Illuminate\Support\Facades\DB;

class ModuleRepository implements ModuleRepositoryInterface
{

    private Module $model;

    public function __construct(Module $module)
    {
        $this->model = $module;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findAllByUserId(int $id): array
    {
        return DB::select('EXEC Man_zg_global ?,?,?,?,?',
            [
                'S05',
                $id,
                null,
                null,
                null
            ]
        );
    }
}
