<?php

namespace App\Repositories\Line;

use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LineRepository implements LineRepositoryInterface
{

    private Line $model;

    public function __construct(Line $model)
    {
        $this->model = $model;
    }

//    /**
//     * @param string $companyId
//     * @param Request $request
//     * @return Collection
//     */
//    public function findAllByCompany(string $companyId, Request $request): Collection
//    {
//        $query = $this->model->query()
//                    ->where("idempresa", "=", $companyId);
//
//        if ($productTypeId = $request->query->get("idtipoproducto")) {
//            $query = $query->where("idtipoproducto", "=", $productTypeId);
//        }
//
//        return $query->get();
//    }

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
