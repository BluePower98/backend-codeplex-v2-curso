<?php

namespace App\Repositories\ZonePrice;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Collection;

interface ZonePriceRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $params): void;

    public function delete(int $productId, string $companyId): void;

    public function findAllByProductAndCompany(int $productId, string $companyId): Collection;
}
