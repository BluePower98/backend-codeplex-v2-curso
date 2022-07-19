<?php

namespace App\Repositories\PlanDetail;

use App\Models\PlanDetail;
use Illuminate\Support\Facades\DB;

class PlanDetailRepository implements PlanDetailRepositoryInterface
{

    private PlanDetail $model;

    public function __construct(PlanDetail $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findAllByPlanId(int $id): array
    {
        return DB::select(
            'Exec Man_zg_global ?,?,?,?,?',
            [
                'S09',
                null,
                null,
                null,
                $id
            ]
        );
    }
}
