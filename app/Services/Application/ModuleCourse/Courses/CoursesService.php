<?php

namespace App\Services\Application\ModuleCourse\Courses;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\ModuleCourse\Courses\CoursesRepositoryInterface;

class CoursesService
{
    private CoursesRepositoryInterface $CoursesRepository;

    public function __construct(
        CoursesRepositoryInterface $CoursesRepository
    )
    {
        $this->CoursesRepository = $CoursesRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->CoursesRepository->datatables($request);
    }

    public function store(Request $request): Collection
    {
        return $this->CoursesRepository->store($request->all());
    }

    public function update(Request $request, string $idempresa, int $idcurso): Collection
    {
        return $this->CoursesRepository->update($request->all(), $idempresa, $idcurso);
    }

    public function delete(string $idempresa, int $idcurso): Collection
    {
        return $this->CoursesRepository->delete($idempresa, $idcurso);
    }  

    public function show(string $idempresa, int $idcurso): Collection
    {
        return $this->CoursesRepository->show($idempresa, $idcurso);
    } 
    
    public function getEspecialidades(string $idempresa): Collection
    {
        return $this->CoursesRepository->getEspecialidades($idempresa);
    }
}