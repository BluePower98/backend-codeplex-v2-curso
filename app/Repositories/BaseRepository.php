<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $criteria
     * @return Model|null
     */
    public function findByCriteria(array $criteria): ?Collection {
        return $this->queryByCriteria($criteria)->get();
    }

    /**
     * @param array $criteria
     * @return Model|null
     */
    public function findOneByCriteria(array $criteria): ?Model {
        return $this->queryByCriteria($criteria)->first();
    }

    /**
     * @param array $criteria
     * @return Model|null
     */
    public function findOneOrFailByCriteria(array $criteria): ?Model {
        if (!$model = $this->findOneByCriteria($criteria)) {
            $exception =  new ModelNotFoundException();
            $exception->setModel(get_class($this->model), array_values($criteria));

            throw $exception;
        }

        return $model;
    }

    public function hello(): string {
        return "Hello world";
    }

    /**
     * @param array $criteria
     * @return void
     */
    public function deleteByCriteria(array $criteria): void
    {
        $this->queryByCriteria($criteria)->delete();
    }

    /**
     * @param array $criteria
     * @return Builder
     */
    private function queryByCriteria(array $criteria): Builder
    {
        $query = $this->model->query();

        foreach ($criteria as $key => $value) {
            $query = $query->where($key, $value);
        }

        return $query;
    }
}
