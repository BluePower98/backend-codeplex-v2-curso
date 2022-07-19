<?php

namespace App\Repositories\Plan;

use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class PlanRepository implements PlanRepositoryInterface
{
    private Plan $model;

    public function __construct(Plan $plan)
    {
        $this->model = $plan;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return DB::select(
            'Exec Man_zg_global ?,?,?,?,?',
            [
                'S08',
                null,
                null,
                null,
                null
            ]
        );
    }
}
