<?php

namespace App\Services\Application\Measure;

use App\Repositories\Measure\MeasureRepositoryInterface;
use Illuminate\Support\Collection;

class MeasureService
{
    private MeasureRepositoryInterface $repository;

    public function __construct(
        MeasureRepositoryInterface $repository
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
