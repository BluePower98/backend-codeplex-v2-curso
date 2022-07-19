<?php

namespace App\Repositories\SubLine;

use App\Models\SubLine;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SubLineRepository implements SubLineRepositoryInterface
{

    private SubLine $model;

    public function __construct(SubLine $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function findAll(Request $request): Collection
    {
        $query = $this->model->query();

        if ($companyId = $request->query->get("idempresa")) {
            $query = $query->where("idempresa", "=", $companyId);
        }

        if ($lineId = $request->query->get("idlinea")) {
            $query = $query->where("idlinea", "=", $lineId);
        }

        if ($productTypeId = $request->query->get("idtipoproducto")) {
            $query = $query->where("idtipoproducto", "=", $productTypeId);
        }

        return $query->get();
    }

    /**
     * @param array $criteria
     * @return Collection
     */
    public function findAllByCriteria(array $criteria): Collection
    {
        $query = $this->model->query();

        foreach ($criteria as $key => $value) {
            if ($this->model->getConnection()->getSchemaBuilder()->hasColumn($this->model->getTable(), $key)) {
                $query->where($key, $value);
            }
        }

        return $query->get();
    }
}
