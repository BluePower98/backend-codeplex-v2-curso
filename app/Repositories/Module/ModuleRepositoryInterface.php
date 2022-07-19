<?php

namespace App\Repositories\Module;

interface ModuleRepositoryInterface
{
    public function findAllByUserId(int $id): array;
}
