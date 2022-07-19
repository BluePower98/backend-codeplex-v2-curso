<?php

namespace App\Services\Application\SubLine;

use App\Repositories\SubLine\SubLineRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SubLineService
{
    private SubLineRepositoryInterface $repository;

    public function __construct(
        SubLineRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function findAll(Request $request): Collection
    {
        return $this->repository->findAll($request);
    }

    /**
     * @param string $companyId
     * @param int $lineId
     * @param int $productTypeId
     * @return Collection
     */
    public function findAllByCompanyAndLineAndProductType(string $companyId, int $lineId, int $productTypeId): Collection
    {
        return $this->repository->findAllByCriteria([
            "idempresa" => $companyId,
            "idlinea" => $lineId,
            "idtipoproducto" => $productTypeId,
        ]);
    }


}
