<?php

namespace App\Http\Resources\Parameter;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\FileHelper;

class ParameterResource extends JsonResource
{
    public function toArray($request):array
    {
        return [
            "produccion"=>$this->produccion,
            "fecha_produccion"=>$this->fecha_produccion,
            "envio_automatic_fac"=>$this->envio_automatic_fac,
            "envio_individual_boletas"=>$this->envio_individual_boletas,
            "sunat_ose"=>$this->sunat_ose,
            "sol_usuario"=>$this->sol_usuario,
            "sol_password"=>$this->sol_password,
            "sol_usuario_secundario"=>$this->sol_usuario_secundario,
            "sol_password_secundario"=>$this->sol_password_secundario,
            "sol_certificado"=>$this->sol_certificado,
            "path_certificado"=>$this->includeCertificado()
        ];

    }

    private function includeCertificado():array
    {
        $entrycertificado = $this->path_certificado;
        $certificado=[];
        if(empty($entrycertificado)){
            return $certificado;
        }
        $server=env('APP_URL');
        $localFile = str_replace($server, '', $entrycertificado);
        $url = $server . $localFile;
        $pathLocalFile = public_path($localFile);
        if (!file_exists($pathLocalFile)) {
            return $certificado;
        }
        $pathInfo = pathinfo($pathLocalFile);
        // $typedoc="";
        // if(strcmp($pathInfo,"application/octet-stream")==0){
        //     $typedoc="application/x-pkcs12";
        // }
        $certificado[] = [
            'url' => $url,
            'name' => $pathInfo['basename'],
            'type' => "application/x-pkcs12",
            'size' => strlen(file_get_contents($pathLocalFile)),
            'dataURL' => FileHelper::getDataURI($pathLocalFile),
        ];
        return $certificado;
    }
}