<?php

namespace App\Services\Application\Module;

use App\Http\Resources\User\UserModuleResource;
use App\Models\User;
use App\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Support\Collection;

class ModuleService
{
    private ModuleRepositoryInterface $repository;

    public function __construct(
        ModuleRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function findAllByUserId(User $user): Collection
    {
        $results = $this->repository->findAllByUserId($user->getKey());

        return UserModuleResource::collection($results)->collection;
    }

    public function findByPrefijoModulo(int $id):Collection
    {

        $result=$this->repository->findByPrefijoModulo($id);
        return collect($result);
    }
}
