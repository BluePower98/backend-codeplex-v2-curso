<?php

namespace App\Repositories\Sunatt07TypeAffectation;

use App\Models\Sunatt07TypeAffectation;
use Illuminate\Support\Collection;

class Sunatt07TypeAffectationRepository implements Sunatt07TypeAffectationRepositoryInterface
{
    private Sunatt07TypeAffectation $model;

    public function __construct(Sunatt07TypeAffectation $model)
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
