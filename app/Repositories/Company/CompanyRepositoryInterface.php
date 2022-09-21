<?php

namespace App\Repositories\Company;

use Illuminate\Support\Collection;

interface CompanyRepositoryInterface
{
    public function findAllByUser(string $userId): Collection;

    public function datatables(string $userId): Collection;

    public function findOneByCompanyId(string $companyId): Collection;

    public function storeUpdate(array $params):void;

    public function delete(string $companyId):void;
}
