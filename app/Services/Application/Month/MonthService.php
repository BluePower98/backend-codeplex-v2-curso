<?php

namespace App\Services\Application\Month;

use App\Repositories\Month\MonthRepositoryInterface;
use Illuminate\Support\Collection;

class MonthService
{
    private MonthRepositoryInterface $repository;

    public function __construct(
        MonthRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->repository->findAll();
    }
}
