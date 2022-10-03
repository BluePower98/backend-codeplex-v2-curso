<?php

namespace App\Repositories\ModuleCourse\Courses;

use App\Models\Cursos;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface CoursesRepositoryInterface extends BaseRepositoryInterface
{
    public function datatables(Request $request): Collection;

    public function store(array $params): Collection;

    public function update(array $params, string $idempresa, int $idcurso): Collection;

    public function delete(string $idempresa, int $idcurso): Collection;

    public function show(string $idempresa, int $idcurso): Collection;

    public function getEspecialidades(string $idempresa): Collection;

}