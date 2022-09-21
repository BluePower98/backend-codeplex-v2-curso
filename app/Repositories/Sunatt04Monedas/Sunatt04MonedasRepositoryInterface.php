<?php

namespace App\Repositories\Sunatt04Monedas;

use Illuminate\Support\Collection;

interface Sunatt04MonedasRepositoryInterface
{
    public function findAllSunatt04Moneda():Collection;
}