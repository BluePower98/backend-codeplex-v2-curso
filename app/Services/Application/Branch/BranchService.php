<?php

namespace App\Services\Application\Branch;

use App\Repositories\Branch\BranchRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Resources\Branch\BranchShowResource;

class BranchService
{
    private BranchRepositoryInterface $repository;

    public function __construct(
        BranchRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param string $companyId
     * @param string $userId
     * @return Collection
     */
    public function findAllByCompanyAndUser(string $companyId, string $userId): Collection
    {
        return $this->repository->findAllByCompanyAndUser($companyId, $userId);
    }

    public function findAllSucursalId(string $companyId,string $prefijo):collection
    {
        $sucusale=[];
        $sucursales=$this->repository->findAllSucursalId($companyId,$prefijo);
        // dd($sucursales);
         foreach($sucursales as $sucusal){
            // $sucusal=new BranchShowResource($sucusal);
            array_push($sucusale,new BranchShowResource($sucusal));
         }
        return collect($sucusale);
    }

    public function datatables(string $companyId):Collection
    {
        return $this->repository->datatables($companyId);
    }

    public function storeupdate(Request $request):void
    {
        $this->repository->storeupdate($request->all());
    }
    
    public function show(string $companyId,int $branchId,string $prefijo):Collection
    {
        $result= $this->repository->show($companyId,$branchId,$prefijo);
        return collect($result);
    }
    public function getOneBranchCompayIdBranchId(string $companyId,int $branchId,string $prefijo):Collection
    {    $sucursal=[];
        $result=$this->repository->getOneBranchCompayIdBranchId($companyId,$branchId,$prefijo);
        foreach($result as $sucusal){
            array_push($sucursal,new BranchShowResource($sucusal));
        }
        return collect($sucursal);
    }

    public function delete(string $prefijo,string $companyId,int $brachId):Collection
    {
         $result= $this->repository->delete($prefijo,$companyId,$brachId);
         return $result;
    }
}
