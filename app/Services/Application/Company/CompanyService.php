<?php

namespace App\Services\Application\Company;

use Illuminate\Support\Collection;
use App\Repositories\Company\CompanyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyService
{
    private CompanyRepositoryInterface $repository;

    public function __construct(
        CompanyRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param string $userId
     * @return Collection
     */
    public function findAllByUser(string $userId): Collection
    {
        return $this->repository->findAllByUser($userId);
    }

    public function datatables(){
        $user=Auth::user();
        $iduserId=$user->{$user->getKeyName()};
        
        return $this->repository->datatables($iduserId);
    }


   public function show(string $companyId):Collection
    {
        // dd($companyId);
        $result= $this->repository->findOneByCompanyId($companyId);

        return $result;
    }

    public function storeUpdate(Request $request):void
    {
        
        $this->repository->storeUpdate($request->all());
    }

    public function update(Request $request):void
    {
        $this->repository->update($request->all());
    }

    public function delete(string $companyId){
        $this->repository->delete($companyId);
    }

}
