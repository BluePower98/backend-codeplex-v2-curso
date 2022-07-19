<?php

namespace App\Services\Application\Sunatt07TypeAffectation;

use App\Repositories\Sunatt07TypeAffectation\Sunatt07TypeAffectationRepositoryInterface;
use Illuminate\Support\Collection;

class Sunatt07TypeAffectationService
{
    private Sunatt07TypeAffectationRepositoryInterface $repository;

    public function __construct(
        Sunatt07TypeAffectationRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->repository->findAll();
    }
}
