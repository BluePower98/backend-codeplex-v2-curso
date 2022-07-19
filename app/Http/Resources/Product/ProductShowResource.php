<?php

namespace App\Http\Resources\Product;

use App\Helpers\FileHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "idempresa" => $this->idempresa,
            "idproducto" => $this->idproducto,
            "idlinea" => $this->idlinea,
            "idlineasub" => $this->idlineasub,
            "idtipoproducto" => $this->idtipoproducto,
            "idsunatt07" => $this->idsunatt07,
            "codigo" => $this->codigo,
            "descripcion" => $this->descripcion,
            "activo" => $this->activo,
            "infad1" => $this->infad1,
            "infad2" => $this->infad2,
            "infad3" => $this->infad3,
            "porpercepcion" => $this->porpercepcion,
            "porisc" => $this->porisc,
            "estadoventa" => $this->estadoventa,
            "escombo" => $this->escombo,
            "imagen1" => $this->imagen1,
            "imagen2" => $this->imagen2,
            "imagen3" => $this->imagen3,
            "imagen4" => $this->imagen4,
            "idsubcategoria" => $this->idsubcategoria,
            "wikimart" => $this->wikimart,
            "xls" => $this->xls,
            "icbper" => $this->icbper,
            "images" => $this->includeImages()
        ];
    }

    /**
     * @return array
     */
    private function includeImages(): array
    {
        $entryImages =  $this->images ?: [];

        $product = $this;

        $images = [];

        foreach ($entryImages as $key => $image) {
            $propertyName = "imagen" . ($key + 1);

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
