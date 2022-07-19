<?php

namespace App\Repositories\Inventory;

interface InventoryRepositoryInterface
{
    public function delete(int $productId, string $companyId): void;
}
