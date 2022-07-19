<?php

namespace App\Repositories\PlanDescription;

interface PlanDescriptionRepositoryInterface
{
    public function findAllByPlanId(int $id): array;
}
