<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            "idempresa"=>"required|string|max:100",
            "ruc"=>"required|string|max:11",
            "nombrerazon"=>"required|string|max:200",
            "nombrecomercial"=>"nullable|string|max:200",
            "nombrecorto"=>"required|string|max:10",
            "direccion"=>"required|string|max:100",
            "ubigeo"=>"required|string|max:6",
            "telefono"=>"nullable|string|max:100",
            "email"=>"nullable|string|max:50",
            "webpage"=>"nullable|string|max:100",
            "activo"=>"required|integer|max:50",
            "logo"=>"nullable|string|max:500",
            "ageret"=>"nullable|integer",
            "ageper"=>"nullable|integer",
            "carritocompras"=>"nullable|integer",
            "giro"=>"nullable|string|max:2000",
        ];
    }
}
