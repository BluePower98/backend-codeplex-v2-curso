<?php

namespace App\Http\Controllers\Api\V1\ModuleCourse\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Application\ModuleCourse\Courses\CoursesService;
use App\Http\Controllers\Api\ApiController;

class CoursesController extends ApiController
{
    private CoursesService $CursosService;

    public function __construct(
        CoursesService $CursosService,
    ) 
    {
        $this->CursosService = $CursosService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->CursosService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        dd($request);
        $result = $this->CursosService->store($request);

        return $this->successResponse($result,"Curso registrado Correctamente");
    }

    public function update(Request $request, string $idempresa, int $idcurso): JsonResponse
    {

        $result = $this->CursosService->update($request, $idempresa, $idcurso);

        return $this->successResponse($result, "Curso actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idcurso): JsonResponse
    {
        $result = $this->CursosService->delete($idempresa, $idcurso);

        return $this->successResponse($result,"El Curso seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idcurso): JsonResponse
    {
        $result = $this->CursosService->show($idempresa, $idcurso);

        return $this->successResponse($result,"El Curso seleccionado a traido los datos correctamente");
    }

    public function getEspecialidades(string $idempresa): JsonResponse
    {
        $result = $this->CursosService->getEspecialidades($idempresa);

        return $this->successResponse($result,"El Curso seleccionado a traido los datos de Especialidades");
    }

}
