<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\FileHelper;


class BranchShowResource extends JsonResource
{
    public function toArray($request):array
    {
        return [
            "idsucursal"=>$this->idsucursal,
            "descripcion"=>$this->descripcion,
            "images"=>$this->includeLogo()
        ];
    }

    private function includeLogo(): array
    {

        $entryImages = $this->logo;

        $images = [];
        if(empty($entryImages)){
            return $images;
        }


            $server = env('APP_URL');
            $localFile = str_replace($server, '', $entryImages);
            $url = $server . $localFile;
            $pathLocalFile = public_path($localFile);

            if (!file_exists($pathLocalFile)) {
                return $images;
            }


            $pathInfo = pathinfo($pathLocalFile);

            $images[] = [
                'url' => $url,
                'name' => $pathInfo['basename'],
                'type' => mime_content_type($pathLocalFile),
                'size' => strlen(file_get_contents($pathLocalFile)),
                'dataURL' => FileHelper::getDataURI($pathLocalFile),
            ];
     
        return $images;

    }
}