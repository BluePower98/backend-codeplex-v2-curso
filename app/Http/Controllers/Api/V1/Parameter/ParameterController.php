<?php

namespace App\Http\Controllers\Api\V1\Parameter;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Parameter\ParameterUpdateRequest;
use App\Services\Application\Parameter\ParameterService;
use Illuminate\Http\JsonResponse;


class ParameterController extends ApiController
{
    //

        private ParameterService $parameterService;
        public function __construct(ParameterService $parameterService)
        {
            $this->parameterService=$parameterService;
        }

        public function show(Request $request):JsonResponse
        {
            $result=$this->parameterService->findOneCompanyId($request->get('CompanyId'),$request->get('prefijo'));
            return $this->successResponse($result);
        }

        public function update(ParameterUpdateRequest $request)
        {
            $result=$this->parameterService->updateOneParameter($request);
            return $this->showMessage('Los datos del comprobante se ha actualizado correctamente.'); 
        }
        public function getComboSoap(Request $request):JsonResponse
        {
            $result=$this->parameterService->getComboSoap($request->get('prefijo'));
            return $this->successResponse($result);
        }

        public function getComboTypeSoap(Request $request):JsonResponse
        {
            $result = $this->parameterService->getComboTypeSoap($request->get('prefijo'));
            return $this->successResponse($result);
        }

        public function getDateSistemByParameterId(string $parameterId):JsonResponse
        {
            $result=$this->parameterService->getDateSistemByParameterId($parameterId);
            return $this->successResponse($result);

            // return $this->showMessage('Los datos del sistema se ha actualizado correctamente.'); 
        }

        public function updateDateSistemByParameterId(ParameterUpdateRequest $request)
        {
            $result=$this->parameterService->updateDateSistemByParameterId($request);
            return $this->showMessage('Los datos del sistema se ha actualizado correctamente.'); 
        }

        public function getComboMethodEnvio():JsonResponse
        {
            $result=$this->parameterService->getComboMethodEnvio();
            return $this->successResponse($result);
        }

        public function gettypedocument(Request $request):JsonResponse
        {
            $result=$this->parameterService->gettypedocument($request->get('parameterId'),$request->get('prefijo'));
            return $this->successResponse($result);
        }
}
