<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory;

class InventoryRepository implements InventoryRepositoryInterface
{
    private Inventory $model;

    public function __construct(Inventory $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $productId
     * @param string $companyId
     * @return void
     */
    public function delete(int $productId, string $companyId): void
    {
        $this->model->query()->where([
            ["idempresa", "=", $companyId],
            ["idproducto", "=", $productId],
            ["stkinventariado", "=", "0"],
        ])->delete();
    }
}
