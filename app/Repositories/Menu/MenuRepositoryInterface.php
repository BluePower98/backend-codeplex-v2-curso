<?php

namespace App\Repositories\Menu;

interface MenuRepositoryInterface
{
    public function findAllByModuleIdAndPlanId(int $moduleId, int $planId, int $userId): array;

    public function findAllPermissionsByUserId(int $id): array;
}
