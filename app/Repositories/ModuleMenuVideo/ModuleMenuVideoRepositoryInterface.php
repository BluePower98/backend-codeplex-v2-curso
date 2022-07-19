<?php

namespace App\Repositories\ModuleMenuVideo;

interface ModuleMenuVideoRepositoryInterface
{
    public function findAllByModuleId(int $id): array;
}
