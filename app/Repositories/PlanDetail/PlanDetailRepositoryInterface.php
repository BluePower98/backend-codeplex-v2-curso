<?php

namespace App\Repositories\PlanDetail;

interface PlanDetailRepositoryInterface
{
    public function findAllByPlanId(int $id): array;
}
