<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCompanyZonePriceResource extends JsonResource
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
            "idzona" => $this->idzona,
            "idproducto" => $this->idproducto,
            "idmedida" => $this->idmedida,
            "Desmedidas" => $this->Desmedidas,
            "idtipoprecio" => $this->idtipoprecio,
            "Deszonastipoprecios" => $this->Deszonastipoprecios,
            "codigoBarra" => $this->Deszonastipoprecios,
            "precioVenta" => number_format($this->precioVenta, 4),
            "cantidadMinVen" => number_format($this->cantidadMinVen, 2),
            "incluidoIgv" => $this->incluidoIgv,
            "defecto" => $this->defecto,
            "peso_kg" => $this->peso_kg,
            "idpropiedad1" => $this->idpropiedad1,
            "idpropiedad2" => $this->idpropiedad2,
            "idpropiedad3" => $this->idpropiedad3,
            "costo" => $this->costo,
            "utilidad_porcen" => $this->utilidad_porcen,
            "precio_minimo" => $this->precio_minimo
        ];
    }
}
