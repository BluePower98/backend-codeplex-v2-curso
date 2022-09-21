<?php

namespace App\Services\Application\Parameter;

use App\Repositories\Parameter\ParameterRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Helpers\FileHelper;
use App\Http\Resources\Parameter\ParameterResource;

class ParameterService
{
    private ParameterRepositoryInterface $repository;

    public function __construct(
        ParameterRepositoryInterface $repository
    )
    {
        $this->repository=$repository;
    }
    public function findOneCompanyId(string $companyId,string $prefijo):array
    {

        return  $this->repository->findOneCompanyId($companyId,$prefijo);
        
    }

    public function updateOneParameter(Request $request):void
    {
        $this->repository->updateOneParameter($request->all());
    }
    public function getComboSoap(string $prefijo):Collection
    {
       
       $result= $this->repository->getComboSoap($prefijo);
     
       return collect($result);

    }
    public function getComboTypeSoap(string $prefijo):Collection
    {
        $result= $this->repository->getComboTypeSoap($prefijo);
        return collect($result);
    }

    public function getDateSistemByParameterId(string $parameterId):Collection
    {
        $certificado=[];
        $result= $this->repository->getDateSistemByParameterId($parameterId);

        foreach($result as $resu){
            array_push($certificado,new ParameterResource($resu));
        }
        return collect($certificado);
    }

    public function updateDateSistemByParameterId(Request $criteria):void
    {
        // dd($criteria->all());
        $certificado=$criteria->only(['certificado']);
        $this->saveCertificado($criteria,$certificado);
    }

    public function getComboMethodEnvio():Collection
    {
        return $this->repository->getComboMethodEnvio();
    }

    private function saveCertificado(Request $request,array $certificado)
    {
        $certificados=array_keys($certificado);

        $upload_path=$request->get('path_certificado')."/";
       
        // dd(count($certificado));
        FileHelper::removeByUrl($upload_path);
        if(count($certificado)==0){
            $url='';
            $request->merge(["path_certificado"=>$url]);

            // dd($request->all());
            $this->repository->updateDateSistemByParameterId($request->all());
        }

        foreach($certificados as $value){
            if(!$request->hasFile($value)){
                continue;
            }
            $file=$request->file($value);
            $fileName="certificado".".".$file->getClientOriginalExtension();
            $file->move($upload_path, $fileName);

            

            $url=$upload_path.$fileName;
            $request->merge(["path_certificado"=>$url]);

            
            $this->repository->updateDateSistemByParameterId($request->all());


        }
    }
    public function gettypedocument(string $parameterId,string $prefijo):Collection
    {
        $result=$this->repository->gettypedocument($parameterId,$prefijo);
        return $result;
    }


}