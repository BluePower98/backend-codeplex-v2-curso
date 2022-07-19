<?php

namespace App\Services\Application\Line;

use App\Repositories\Line\LineRepositoryInterface;
use Illuminate\Support\Collection;

class LineService
{
    private LineRepositoryInterface $repository;

    public function __construct(
        LineRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param string $companyId
     * @param int $productTypeId
     * @return Collection
     */
    public function findAllByCompanyAndProductType(string $companyId, int $productTypeId): Collection
    {
        return $this->repository->findAllByCriteria([
            'idempresa' => $companyId,
            'idtipoproducto' => $productTypeId,
        ]);
    }
}
