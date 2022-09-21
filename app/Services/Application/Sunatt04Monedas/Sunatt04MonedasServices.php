<?php

namespace App\Services\Application\Sunatt04Monedas;

use App\Repositories\Sunatt04Monedas\Sunatt04MonedasRepositoryInterface;
use Illuminate\Support\Collection;
// use App\Repositories\Sunatt04Monedas\Sunatt04MonedasRepositoryInterface;

class Sunatt04MonedasServices
{
    private Sunatt04MonedasRepositoryInterface $repository;

    public function __construct(
        Sunatt04MonedasRepositoryInterface $repository
    )
    {
      $this->repository=$repository;   
    }

    public function findAllSunatt04Moneda():Collection
    {
        // dd('dss');
        return $this->repository->findAllSunatt04Moneda();
    }
}