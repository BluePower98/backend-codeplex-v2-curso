<?php

namespace App\Repositories\Zone;

use Illuminate\Support\Collection;

interface ZoneRepositoryInterface
{
    public function findAllByCompany(string $companyId): Collection;
}
