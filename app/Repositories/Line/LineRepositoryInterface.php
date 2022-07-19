<?php

namespace App\Repositories\Line;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface LineRepositoryInterface
{
    // public function findAllByCompany(string $companyId, Request $request): Collection;

    public function findAllByCriteria(array $criteria): Collection;
}
