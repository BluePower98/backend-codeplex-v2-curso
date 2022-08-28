<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function findAll(Request $request): array;

    public function datatables(Request $request): Collection;

    public function generateCode(string $companyId, int $productTypeId): int;

    public function delete(int $productId, string $companyId): void;

    public function store(array $params): Product;

    public function update(int $productId, array $params): void;
}
