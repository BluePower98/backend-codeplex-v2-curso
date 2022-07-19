<?php

namespace App\Services\Application\Year;

use App\Repositories\Year\YearRepositoryInterface;
use Illuminate\Support\Collection;

class YearService
{
    private YearRepositoryInterface $repository;

    public function __construct(
        YearRepositoryInterface $repository
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
