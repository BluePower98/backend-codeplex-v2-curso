<?php

namespace App\Repositories\PlanDescription;

use App\Models\PlanDescription;
use Illuminate\Support\Facades\DB;

class PlanDescriptionRepository implements PlanDescriptionRepositoryInterface
{
    private PlanDescription $model;

    public function __construct(PlanDescription $model)
    {
        $this->model = $model;
    }

    public function findAllByPlanId(int $id): array
    {
        return DB::select(
            'Exec Man_zg_global ?,?,?,?,?',
            [
                'S10',
                null,
                null,
                null,
                $id
            ]
        );
    }
}
