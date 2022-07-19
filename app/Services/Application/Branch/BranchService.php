<?php

namespace App\Services\Application\Branch;

use App\Repositories\Branch\BranchRepositoryInterface;
use Illuminate\Support\Collection;

class BranchService
{
    private BranchRepositoryInterface $repository;

    public function __construct(
        BranchRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param string $companyId
     * @param string $userId
     * @return Collection
     */
    public function findAllByCompanyAndUser(string $companyId, string $userId): Collection
    {
        return $this->repository->findAllByCompanyAndUser($companyId, $userId);
    }
}
