<?php

namespace App\Services\Application\Company;

use Illuminate\Support\Collection;
use App\Repositories\Company\CompanyRepositoryInterface;

class CompanyService
{
    private CompanyRepositoryInterface $repository;

    public function __construct(
        CompanyRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param string $userId
     * @return Collection
     */
    public function findAllByUser(string $userId): Collection
    {
        return $this->repository->findAllByUser($userId);
    }
}
