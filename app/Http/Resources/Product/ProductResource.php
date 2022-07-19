<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "idempresa" => $this->idempresa,
            "idproducto" => $this->idproducto,
            "idtipoproducto" => $this->idtipoproducto,
            "Destipoproductos" => $this->Destipoproductos,
            "idlinea" => $this->idlinea,
            "Deslineas" => $this->Deslineas,
            "idlineasub" => $this->idlineasub,
            "Deslineassub" => $this->Deslineassub,
            "idsunatt07" => $this->idsunatt07,
            "Dessunatt07" => $this->Dessunatt07,
            "codigo" => $this->codigo,
            "descripcion" => $this->descripcion,
            "activo" => $this->activo,
            "infad1" => $this->infad1,
            "infad2" => $this->infad2,
            "infad3" => $this->infad3,
            "porpercepcion" => $this->porpercepcion,
            "porisc" => $this->porisc,
            "estadoventa" => $this->estadoventa,
            "escombo" => $this->escombo
        ];
    }
}


