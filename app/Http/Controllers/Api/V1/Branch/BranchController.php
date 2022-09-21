<?php

namespace App\Http\Controllers\Api\V1\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Branch\BranchStoreRequest;
use App\Services\Application\Branch\BranchService;
use App\Services\Application\Branch\BranchUpdateService;
use Illuminate\Http\JsonResponse;


class BranchController extends ApiController
{
    private BranchService $branchservice;
    private BranchUpdateService $branchUpdateService;
    public function __construct(
        BranchService $branchservice,
        BranchUpdateService $branchUpdateService
    )
    {
        $this->branchservice=$branchservice;
        $this->branchUpdateService=$branchUpdateService;
    }

    public function show(Request $request):JsonResponse
    {
        $result=$this->branchservice->findAllSucursalId($request->get('sucursalId'),$request->get('prefijo'));
        return $this->successResponse($result);
    }

    public function datatables(string $companyId){
        $results=$this->branchservice->datatables($companyId);
        return $this->datatablesResponse($results);
    }

    public function store(BranchStoreRequest $request)
    {
        $this->branchservice->storeupdate($request);
        return $this->showMessage("La sucursal se registro correctamente");

    }
    public function update(BranchStoreRequest $request)
    {
        $this->branchservice->storeupdate($request);
        return $this->showMessage("La sucursal seleccionada se actualizo correctamente");

    }

    public function showBranch(string $companyId,int $branchId,string $prefijo):JsonResponse
    {
       
        $result=$this->branchservice->show($companyId,$branchId,$prefijo);
        return $this->successResponse($result);
    }

    public function updateLogo(BranchStoreRequest $request){
    
        $this->branchUpdateService->updateLogo($request);

        return $this->showMessage("El logo se actualizo correctamente");

    }
    public function getOneBranchCompayIdBranchId(string $companyId,int $branchId,string $prefijo):JsonResponse
    {
        $result=$this->branchservice->getOneBranchCompayIdBranchId($companyId,$branchId,$prefijo);
        return $this->successResponse($result);
    }

    public function delete(int $brachId,string $companyId,string $prefijo):JsonResponse
    {
     
        $resul=$this->branchservice->delete($prefijo,$companyId,$brachId);
        return $this->successResponse($resul);
    }
}
