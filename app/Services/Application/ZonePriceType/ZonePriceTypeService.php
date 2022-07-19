<?php

namespace App\Services\Application\ZonePriceType;

use App\Repositories\ZonePriceType\ZonePriceTypeRepositoryInterface;
use Illuminate\Support\Collection;

class ZonePriceTypeService
{
    private ZonePriceTypeRepositoryInterface $repository;

    public function __construct(
        ZonePriceTypeRepositoryInterface $repository
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
