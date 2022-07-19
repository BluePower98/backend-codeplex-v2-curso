<?php

namespace App\Repositories\Branch;

use Illuminate\Support\Collection;

interface BranchRepositoryInterface
{
    public function findAllByCompanyAndUser(string $companyId, string $userId): Collection;
}
