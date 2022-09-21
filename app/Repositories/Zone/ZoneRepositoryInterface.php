<?php

namespace App\Repositories\Zone;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

interface ZoneRepositoryInterface
{
    public function findAllByCompany(string $companyId): Collection;

    public function getComboBox(string $companyId,string $prefijo):Collection;

    public function getZonasSunat04(string $companyId):Collection;

    public function storeUpdate(Request $request):Collection;

    public function delete(string $companyId,int $zonaId):Collection;
}
