<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Company;
use App\Services\Application\Company\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;



class IntegrationCompanyController extends ApiController
{
    //
    private CompanyService $companyService;
    public function __construct(CompanyService $companyService)
    {
        $this->companyService=$companyService;
    }
    public function show(Request $request):JsonResponse
    {
        $result=$this->companyService->show($request->get("idempresa"));
        return $this->successResponse($result);
        // return $this->successResponse($request->get('idempresa'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function datatables(){
        // dd('sasa');
        $results=$this->companyService->datatables();
        // dd($results);
        // return DataTables::of($results)->make(true);
        // return $this->successResponse(DataTables::of($results)->make(true));
        return $this->datatablesResponse($results);
    }

    public function store(CompanyStoreRequest $request){
        $this->companyService->storeUpdate($request);
        return $this->showMessage('La empresa se ha registrado Correctamente.',Response::HTTP_CREATED);
    }
    public function update(CompanyUpdateRequest $request)
    {
        $this->companyService->storeUpdate($request);
        return $this->showMessage('Los datos de la empresa ha sido actualizado correctamente.');
    }

    public function delete(string $company){
        $this->companyService->delete($company);
        // return $this->showMessage('La empresa seleccionada se ha eliminado correctamente',Response::HTTP_NO_CONTENT);
        return $this->showMessage("La empresa seleccionada se ha eliminado correctamente");
    }
}
