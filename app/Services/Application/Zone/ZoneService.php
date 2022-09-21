<?php

namespace App\Services\Application\Zone;

use App\Repositories\Zone\ZoneRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

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

    public function getComboBox(string $companyId,string $prefijo):Collection
    {
        return $this->repository->getComboBox($companyId,$prefijo);
    }
    public function getZonasSunat04(string $companyId):Collection
    {
        return $this->repository->getZonasSunat04($companyId);
    }
    public function storeUpdate(Request $request):Collection
    {
        return $this->repository->storeUpdate($request);
    }
    public function delete(string $companyId,int $zonaId):Collection
    {
        return $this->repository->delete($companyId,$zonaId);
    }
    
}
