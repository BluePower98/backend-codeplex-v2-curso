<?php

namespace App\Repositories\Module;
use Illuminate\Support\Collection;

interface ModuleRepositoryInterface
{
    public function findAllByUserId(int $id): array;
    
    public function findByPrefijoModulo(int $id):Collection;

}
