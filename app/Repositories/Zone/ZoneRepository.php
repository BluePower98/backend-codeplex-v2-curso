<?php

namespace App\Repositories\Zone;

use App\Models\Zone;
use Illuminate\Support\Collection;

class ZoneRepository implements ZoneRepositoryInterface
{
    private Zone $model;

    public function __construct(Zone $model)
    {
        $this->model = $model;
    }


    /**
     * @param string $companyId
     * @return Collection
     */
    public function findAllByCompany(string $companyId): Collection
    {
        return $this->model->query()
                    ->where("idempresa", "=", $companyId)
                    ->get();
    }
}
