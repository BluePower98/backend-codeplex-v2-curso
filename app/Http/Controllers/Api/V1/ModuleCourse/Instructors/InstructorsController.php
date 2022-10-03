<?php

namespace App\Http\Controllers\Api\V1\ModuleCourse\Instructors;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\ModuleCourse\Instructors\InstructorsService;
use App\Http\Controllers\Api\ApiController;

class InstructorsController extends ApiController
{
    private InstructorsService $InstructorsService;

    public function __construct(
        InstructorsService $InstructoresService,
    )
    {
        $this->InstructoresService = $InstructoresService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->InstructoresService->datatables($request);

        return $this->datatablesResponse($result);
    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->InstructoresService->store($request);

        return $this->successResponse($result,"Instructor registrado Correctamente");
    }

    public function update(Request $request, string $idempresa, int $idinstructor): JsonResponse
    {

        $result = $this->InstructoresService->update($request, $idempresa, $idinstructor);

        return $this->successResponse($result, "Instructor actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idinstructor): JsonResponse
    {
        $result = $this->InstructoresService->delete($idempresa, $idinstructor);

        return $this->successResponse($result,"El Instructor seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idinstructor): JsonResponse
    {
        $result = $this->InstructoresService->show($idempresa, $idinstructor);

        return $this->successResponse($result,"El Instructor  seleccionado a traido los datos correctamente");
    }
}
