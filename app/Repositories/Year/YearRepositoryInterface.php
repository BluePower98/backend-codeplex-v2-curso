<?php

namespace App\Repositories\Year;

use Illuminate\Support\Collection;

interface YearRepositoryInterface
{
    public function findAll(): Collection;
}
