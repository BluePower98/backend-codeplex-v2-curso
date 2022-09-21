<?php

namespace App\Http\Requests\Zona;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class zonaRequest extends FormRequest
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
            "idzona"=>"required|integer",
            "idmoneda"=>"nullable|integer",
            "Descripcion"=>"nullable|string|max:50",
            "wikimart"=>"nullable"
        ];
    }
}
