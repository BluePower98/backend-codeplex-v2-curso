<?php

namespace App\Repositories\ZonePriceType;

use App\Models\ZonePriceType;
use Illuminate\Support\Collection;

class ZonePriceTypeRepository implements ZonePriceTypeRepositoryInterface
{

    private ZonePriceType $model;

    public function __construct(ZonePriceType $model)
    {
        $this->model = $model;
    }

    public function findAll(): Collection
    {
        return $this->model->all();
    }
}
