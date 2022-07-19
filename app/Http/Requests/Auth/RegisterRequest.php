<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "idplan" => "required",
            "nombre" => "required",
            "email" => "required|email|unique:zg_usuarios,loglogin",
            "password" => "required|min:6",
            "ruc" => "required|only_numbers|min:11|max:11|unique:zg_empresas,ruc",
            "razon" => "required",
            "telefono" => "required|only_numbers"
        ];
    }

    public function messages(): array
    {
        return [
            "email.unique" => "El :attribute ya se encuentra registrado."
        ];
    }
}
