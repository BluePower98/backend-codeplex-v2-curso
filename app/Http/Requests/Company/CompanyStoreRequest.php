<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            "idusuario"=>"required|string",
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
//             activo: 1++
// ageper: null++
// ageret: null++
// carritocompras: null++
// direccion: "AV. REP DE PANAMA NRO. 3055 URB. EL PALOMAR"++
// email: null++
// giro: null
// idempresa: null
// logo: null++
// nombrecomercial: null++
// nombrecorto: "trttrtrrrtrttr"++
// nombrerazon: "BANCO BBVA PERU"++
// ruc: "20100130204"++
// telefono: null++
// ubigeo: "150131"++
// webpage: null++
        ];
    }
}
