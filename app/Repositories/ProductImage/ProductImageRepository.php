<?php

namespace App\Repositories\ProductImage;

use App\Models\ProductImage;
use App\Repositories\BaseRepository;

class ProductImageRepository extends BaseRepository implements ProductImageRepositoryInterface
{
    public function __construct(ProductImage $model)
    {
        parent::__construct($model);
    }


    /**
     * @param array $params
     * @return ProductImage
     */
    public function store(array $params): ProductImage
    {
        return $this->model->query()->create($params);


        // TODO: pruebas
    }
}
