<?php

namespace App\Repositories\Branch;

use Illuminate\Support\Collection;

interface BranchRepositoryInterface
{
    public function findAllByCompanyAndUser(string $companyId, string $userId): Collection;

    public function findAllSucursalId(string $companyId,string $prefijo):Collection;

    public function datatables(string $companyId):Collection;

    public function storeupdate(array $params):void;

    public function show(string $companyId,int $branchId,string $prefijo):Collection;

    public function updatelogo(array $params):void;

    public function getOneBranchCompayIdBranchId(string $companyId,int $branchId,string $prefijo):Collection;

    public function delete(string $prefijo,string $companyId,int $brachId):Collection;
}
