<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class BranchStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "prefijo"=>"nullable|string|max:3",
            "idempresa"=>"required|string|max:100",
            "idsucursal"=>"nullable|integer",
            "codigo"=>"nullable|string|max:30",
            "idzona"=>"nullable|integer",
            "descripcion"=>"nullable|string|max:70",
            "cuo"=>"nullable|string|max:6",
            "direccion"=>"nullable|string|max:300",
            "telefono"=>"nullable|string|max:100",
            "email"=>"nullable|string|max:100",
            "ubigeo"=>"nullable|string|max:6",
            "principal"=>"nullable|integer",
            "responsable"=>"nullable|string|max:50",
            "activo"=>"nullable|integer",
            "logo"=>"nullable|string|max:500",
            "upload_path" => "nullable|string"
        ];
    }
}
