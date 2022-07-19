<?php

namespace App\Repositories\Month;

use Illuminate\Support\Collection;

interface MonthRepositoryInterface
{
    public function findAll(): Collection;
}
