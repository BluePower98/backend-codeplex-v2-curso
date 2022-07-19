<?php

namespace App\Repositories\ModuleMenuVideo;

use App\Models\ModuleMenuVideo;

class ModuleMenuVideoRepository implements ModuleMenuVideoRepositoryInterface
{

    private ModuleMenuVideo $model;

    public function __construct(ModuleMenuVideo $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findAllByModuleId(int $id): array
    {
        return $this->model->query()->where(['idModulo' => $id])->get()->toArray();
    }
}
