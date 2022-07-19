<?php

namespace App\Repositories\Company;

use Illuminate\Support\Collection;

interface CompanyRepositoryInterface
{
    public function findAllByUser(string $userId): Collection;
}
