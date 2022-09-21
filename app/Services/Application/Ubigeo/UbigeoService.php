<?php
namespace App\Services\Application\Ubigeo;

use App\Repositories\Ubigeo\UbigeoRepositoryInterface;

class UbigeoService
{
    private UbigeoRepositoryInterface $ubigeoRespository;
    
    public function __construct(
        UbigeoRepositoryInterface $ubigeoRespository
    )
    {
        $this->ubigeoRespository = $ubigeoRespository;
    }

    public function findAllByUbigeoId(string $ubigeoId):array
    {
        return $this->ubigeoRespository->findAllByUbigeoId($ubigeoId);
        
    }
}