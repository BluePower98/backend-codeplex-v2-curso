<?php

namespace App\Repositories\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class MenuRepository implements MenuRepositoryInterface
{

    private Menu $model;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function findAllByModuleIdAndPlanId(int $moduleId, int $planId, int $userId): array
    {
        return DB::select('EXEC Man_zg_global ?,?,?,?,?',
            ['S06', $userId,  null, $moduleId, $planId ]
        );
    }

    public function findAllPermissionsByUserId(int $id): array
    {
        return DB::select(
            'EXEC Man_zg_global ?,?,?,?,?',
            [ 'S15', $id, null, null, null]
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
