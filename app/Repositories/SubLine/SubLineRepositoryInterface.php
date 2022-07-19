<?php

namespace App\Repositories\SubLine;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface SubLineRepositoryInterface
{
    public function findAll(Request $request): Collection;

    public function findAllByCriteria(array $criteria): Collection;
}
