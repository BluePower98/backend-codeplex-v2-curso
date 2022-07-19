<?php

namespace App\Repositories\Year;

use App\Models\Year;
use Illuminate\Support\Collection;

class YearRepository implements YearRepositoryInterface
{

    private Year $model;

    public function __construct(Year $model)
    {
        $this->model = $model;
    }


    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->all();
    }
}
