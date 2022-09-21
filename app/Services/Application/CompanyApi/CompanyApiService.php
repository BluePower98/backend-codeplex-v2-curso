<?php

namespace App\Services\Application\CompanyApi;

use App\Repositories\CompanyApi\CompanyApiRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CompanyApiService
{
    private CompanyApiRepositoryInterface $repostory;

    public function __construct(
        CompanyApiRepositoryInterface $repostory
    )
    {
        $this->repostory = $repostory;
    }

    public function datatables(Request $request):Collection{

        // dd($request->all());
        $user=Auth::user();
        $iduser=$user->{$user->getKeyName()};
        $result= $this->repostory->datatables($iduser,$request);
        // dd($result);
        // 
        return collect($result);
    }
}