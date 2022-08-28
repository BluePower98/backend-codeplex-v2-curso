<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
        $product = $this->route('product');

        return [
            "idempresa" => "required|string|exists:zg_empresas",
            "idlinea" => "required|integer|exists:lo_lineas,idlinea",
            "idlineasub" => "required|integer|exists:lo_lineassub,idlineasub",
            "idtipoproducto" => "required|integer|exists:zg_tipoproductos,idtipoproducto",
            "idsunatt07" => "nullable|string|max:3|exists:st_sunatt07_tipo_afectaciones,idsunatt07",
            "codigo" => [
                "required",
                "string",
                "max:50",
                Rule::unique("lo_productos", "codigo")
                    ->where("idempresa", $this->request->get("idempresa"))
                    ->where("idtipoproducto", $this->request->get("idtipoproducto"))
                    ->whereNot("idproducto", $product->idproducto)
            ],
            "descripcion" => "nullable|max:3000",
            "activo" => "nullable|string",
            "infad1" => "nullable|max:3000",
            "infad2" => "nullable|max:3000",
            "infad3" => "nullable|max:3000",
            "porpercepcion" => "nullable|integer",
            "porisc" => "nullable|integer",
            "estadoventa" => "nullable|string",
            "escombo" => "nullable|string",
            "icbper" => "nullable|string",
            "urlapi" => "nullable|string|max:100",
            "itemPrecios" => "nullable|string",
            "imagen1" => "nullable|mimes:jpg,jpeg,png|max:5120",
            "imagen2" => "nullable|mimes:jpg,jpeg,png|max:5120",
            "imagen3" => "nullable|mimes:jpg,jpeg,png|max:5120",
            "imagen4" => "nullable|mimes:jpg,jpeg,png|max:5120",
            'upload_path' => [
                Rule::requiredIf(function() {
                    return (
                        !empty($this->file('imagen1')) ||
                        !empty($this->file('imagen2')) ||
                        !empty($this->file('imagen3')) ||
                        !empty($this->file('imagen4'))
                    );
                })
            ]
        ];
    }
}
