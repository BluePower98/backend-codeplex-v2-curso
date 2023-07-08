<?php

namespace App\Http\Resources\ModuleCourse;

use App\Helpers\FileHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class DetalleCursoImage extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "idempresa" => $this->idempresa,
            "iddetallecurso" => $this->iddetallecurso,
            "idcurso" => $this->idcurso,
            "idespecialidad" => $this->idespecialidad,
            "idinstructor" => $this->idinstructor,
            "detalledecurso" => $this->detalledecurso,
            "lección" => $this->lección,
            "cuestionarios" => $this->cuestionarios,
            "estudiantes" => $this->estudiantes,
            "duración" => $this->duración,
            "certificado" => $this->certificado,
            "whassap" => $this->whassap,
            "activo" => $this->activo,
            "fotos" => $this->includeImages()
        ];
    }

    private function includeImages(): array
    {
        $entryImages =  $this->images ?: [];

        $product = $this;

        $images = [];

        foreach ($entryImages as $key => $image) {
            $propertyName = "fotos" . ($key + 1);

            $server = env('APP_URL');
            $localFile = str_replace($server, '', $image->imagen);
            $url = $server . $localFile;
            $pathLocalFile = public_path($localFile);

            if (!file_exists($pathLocalFile)) {
                continue;
            }

            if (property_exists($product, $propertyName)) {
                $product->{$propertyName} = $url;
            }

            $pathInfo = pathinfo($pathLocalFile);

            $images[] = [
                'url' => $url,
                'name' => $pathInfo['basename'],
                'type' => mime_content_type($pathLocalFile),
                'size' => strlen(file_get_contents($pathLocalFile)),
                'dataURL' => FileHelper::getDataURI($pathLocalFile),
            ];
        }

        return $images;
    }
}