<?php

namespace App\Repositories\ModuleCourse\CourseDetails;

use App\Models\CourseDetails;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface CourseDetailsRepositoryInterface extends BaseRepositoryInterface
{
    public function datatables(Request $request): Collection;

    public function store(array $params): Collection;

    public function update(array $params, string $idempresa, int $iddetallecurso): Collection;

    public function delete(string $idempresa, int $iddetallecurso): Collection;

    public function show(string $idempresa, int $iddetallecurso): Collection;

    public function getCursos(string $idempresa): Collection;

    public function getEspecialidades(string $idempresa, int $idespecialidad): Collection;


}