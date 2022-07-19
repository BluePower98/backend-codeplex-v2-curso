<?php

namespace App\Services\Application\Zone;

use App\Repositories\Zone\ZoneRepositoryInterface;
use Illuminate\Support\Collection;

class ZoneService
{
    private ZoneRepositoryInterface $repository;

    public function __construct(
        ZoneRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param string $companyId
     * @return Collection
     */
    public function findAllByCompany(string $companyId): Collection
    {
        return $this->repository->findAllByCompany($companyId);
    }
}
