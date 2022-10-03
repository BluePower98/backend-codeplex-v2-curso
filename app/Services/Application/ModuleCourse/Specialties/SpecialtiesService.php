<?php

namespace App\Services\Application\ModuleCourse\Specialties;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\ModuleCourse\Specialties\SpecialtiesRepositoryInterface;

class SpecialtiesService
{
    private SpecialtiesRepositoryInterface $SpecialtiesRepository;

    public function __construct(
        SpecialtiesRepositoryInterface $SpecialtiesRepository
    )
    {
        $this->SpecialtiesRepository = $SpecialtiesRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->SpecialtiesRepository->datatables($request);
    }

    public function store(Request $request): Collection
    {
        return $this->SpecialtiesRepository->store($request->all());
    }

    public function update(Request $request, string $idempresa, int $idespecialidad): Collection
    {
        return $this->SpecialtiesRepository->update($request->all(), $idempresa, $idespecialidad);
    }

    public function delete(string $idempresa, int $idespecialidad): Collection
    {
        return $this->SpecialtiesRepository->delete($idempresa, $idespecialidad);
    }  

    public function show(string $idempresa, int $idespecialidad): Collection
    {
        return $this->SpecialtiesRepository->show($idempresa, $idespecialidad);
    }  
}