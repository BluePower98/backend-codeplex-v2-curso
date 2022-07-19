<?php

namespace App\Repositories\ZonePriceType;

use Illuminate\Support\Collection;

interface ZonePriceTypeRepositoryInterface
{
    public function findAll(): Collection;
}
