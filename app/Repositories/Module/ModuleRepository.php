<?php

namespace App\Repositories\Module;

use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

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
    
    public function findByPrefijoModulo(int $id):Collection
    {
        return DB::table("zg_modulos","M")
                ->select(["M.prefijo"])
                ->join("zg_planes AS P","M.idmodulo","=","P.idmodulo")
                ->where("P.idplan","=",$id)->get();
    }
}
