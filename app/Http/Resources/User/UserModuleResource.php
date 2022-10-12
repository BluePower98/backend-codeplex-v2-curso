<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserModuleResource extends JsonResource
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
            "idmodulo" => $this->idmodulo,
            "desmodulo" => $this->desmodulo,
            "idplan" => $this->idplan,
            "subdominio"=>$this->subdominio,
            "subdominioprod"=>$this->subdominio
        ];
    }
}
