<?php

namespace App\Repositories\Measure;

use App\Models\Measure;
use Illuminate\Support\Collection;

class MeasureRepository implements MeasureRepositoryInterface
{

    private Measure $model;

    public function __construct(Measure $model)
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
