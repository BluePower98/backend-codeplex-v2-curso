<?php

namespace App\Services\Application\ZonePrice;

use App\Http\Resources\Product\ProductCompanyZonePriceResource;
use App\Repositories\ZonePrice\ZonePriceRepositoryInterface;
use Illuminate\Support\Collection;

class ZonePriceService
{
    private ZonePriceRepositoryInterface $repository;

    public function __construct(
        ZonePriceRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param int $productId
     * @param string $companyId
     * @return Collection
     */
    public function findAllByProductAndCompany(int $productId, string $companyId): Collection
    {
        $results = $this->repository->findAllByProductAndCompany($productId, $companyId);

        return ProductCompanyZonePriceResource::collection($results)->collection;
    }
}
