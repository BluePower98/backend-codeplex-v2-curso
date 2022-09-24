<?php

namespace App\Http\Controllers\Api\V1\Integrador\Company;

use App\Http\Controllers\Api\ApiController;
use App\Models\Company;
use App\Services\Application\Zone\ZoneService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Zona\zonaRequest;

class IntCompanyZoneController extends ApiController
{
    private ZoneService $zoneService;

    public function __construct(
        ZoneService $zoneService
    )
    {
        $this->zoneService = $zoneService;
    }

    public function getComboBox(Company $company,string $prefijo): JsonResponse
    {
        // dd('assaas',$company->getkey());
        $result=$this->zoneService->getComboBox($company->getkey(),$prefijo);
        // dd($result);
        return $this->successResponse($result);
    }
    public function getZonasS04(Company $company):JsonResponse
    {
        // dd($company->getKey());
        $result=$this->zoneService->getZonasSunat04($company->getKey());
        return $this->successResponse($result);
    }

    public function storeUpdate(zonaRequest $request):JsonResponse
    {
        // dd($request);
        $result=$this->zoneService->storeUpdate($request);
        return $this->successResponse($result);
    }

    public function delete(string $companyId,int $zonaId):JsonResponse
    {
        // dd('ssdds',$companyId);
        $result=$this->zoneService->delete($companyId,$zonaId);
        return $this->successResponse($result,'Datos Eliminados');
    }


}
