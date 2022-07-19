<?php

namespace App\Repositories\Measure;

use Illuminate\Support\Collection;

interface MeasureRepositoryInterface
{
    public function findAllByCompany(string $companyId): Collection;
}
