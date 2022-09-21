<?php 
namespace App\Repositories\Parameter;

use Illuminate\Support\Collection;

interface ParameterRepositoryInterface
{
    public function findOneCompanyId(string $CompanyId, string $prefijo):array;

    public function updateOneParameter(array $criteria):void;

    public function getComboSoap(string $prefijo):Collection;

    public function getComboTypeSoap(string $prefijo):Collection;

    public function getDateSistemByParameterId(string $parameterId):Collection;

    public function updateDateSistemByParameterId(array $criteria):void;

    public function getComboMethodEnvio():Collection;

    public function gettypedocument(string $parameterId,string $prefijo):Collection;
}