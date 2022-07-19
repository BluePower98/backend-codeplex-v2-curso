<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function findByCriteria(array $criteria): ?Collection;

    public function findOneByCriteria(array $criteria): ?Model;

    public function findOneOrFailByCriteria(array $criteria): ?Model;

    public function deleteByCriteria(array $criteria): void;

    public function hello(): string;
}
