<?php

namespace App\Repositories\ProductImage;

use App\Models\ProductImage;
use App\Repositories\BaseRepositoryInterface;

interface ProductImageRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $params): ProductImage;
}
