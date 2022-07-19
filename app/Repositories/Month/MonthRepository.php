<?php

namespace App\Repositories\Month;

use App\Models\Month;
use Illuminate\Support\Collection;

class MonthRepository  implements MonthRepositoryInterface
{

    private Month $model;

    public function __construct(Month $model)
    {
        $this->model = $model;
    }

    public function findAll(): Collection
    {
        return $this->model->all();
    }
}
