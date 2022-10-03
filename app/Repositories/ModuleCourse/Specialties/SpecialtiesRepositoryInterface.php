<?php

namespace App\Repositories\ModuleCourse\Specialties;

use App\Models\Especialidades;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface SpecialtiesRepositoryInterface extends BaseRepositoryInterface
{
    public function datatables(Request $request): Collection;

    public function store(array $params): Collection;

    public function update(array $params, string $idempresa, int $idespecialidad): Collection;

    public function delete(string $idempresa, int $idespecialidad): Collection;

    public function show(string $idempresa, int $idcurso): Collection;
}