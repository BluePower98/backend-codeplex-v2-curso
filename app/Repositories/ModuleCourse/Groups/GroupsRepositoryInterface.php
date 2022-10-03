<?php

namespace App\Repositories\ModuleCourse\Groups;

use App\Models\Grupos;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface GroupsRepositoryInterface extends BaseRepositoryInterface
{
    public function datatables(Request $request): Collection;

    public function store(array $params): Collection;

    public function update(array $params, string $idempresa, int $idgrupo): Collection;

    public function delete(string $idempresa, int $idgrupo): Collection;

    public function show(string $idempresa, int $idgrupo): Collection;

    public function getCursos(string $idempresa): Collection;

    public function getMondedas(): Collection;
}
