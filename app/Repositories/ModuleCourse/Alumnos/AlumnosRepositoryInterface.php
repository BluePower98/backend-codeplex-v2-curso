<?php

namespace App\Repositories\ModuleCourse\Alumnos;

use App\Models\alumnos;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface AlumnosRepositoryInterface extends BaseRepositoryInterface
{
    public function datatables(Request $request): Collection;

    public function store(array $params): Collection;

    public function update(array $params, string $idempresa, string $idalumno): Collection;

    public function delete(string $idempresa, string $idalumno): Collection;

    public function show(string $idempresa, string $idalumno): Collection;

}