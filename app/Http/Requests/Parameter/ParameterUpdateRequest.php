<?php

namespace App\Http\Requests\Parameter;

use Illuminate\Foundation\Http\FormRequest;

class ParameterUpdateRequest extends FormRequest
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
            "prefijo"=>"nullable|string|max:3",
            "idtipodocumento"=>"nullable|integer",		
            "msj_comprobante"=>"nullable|string|max:1000",		
            "msj_otros"=>"nullable|string|max:1000" ,		
            "pie_comprobante"=>"nullable|string|max:1000",	
            "nro_cuentas"=>"nullable|string|max:2000",		
            "formato_impresion"=>"nullable|string|max:15",		
            "otros_doc_logo"=>"nullable|boolean",	
            "espaciodias"=>"nullable|integer" , 		
            "idproducto"=>"nullable|integer" ,		
            "acreditar_ventas"=>"nullable|boolean",		
            "aperturar_caja_ventas"=>"nullable|boolean" ,		
            "imprimir"=>"nullable|boolean",		
            "vista_previa_movil"=>"nullable|boolean",		
            "pag_margin_left_80mm"=>"nullable|integer" , 		
            "text_size_80mm"=>"nullable|numeric|between:0.00,99.99", 		
            "impresion_dsto"=>"nullable|boolean",		
            "centrar_logo"=>"nullable|boolean",		
            "idformapago"=>"nullable|string|max:3",		
            "sell_multiple_products"=>"nullable|boolean",
            "produccion"=>"nullable|min:0|max:1",
            "fecha_produccion"=>"nullable|string|max:20",
            "envio_automatic_fac"=>"nullable|",
            "envio_individual_boletas"=>"nullable",
            "sunat_ose"=>"nullable|integer",
            "sol_usuario"=>"nullable|string|max:50",
            "sol_password"=>"nullable|string|max:50",
            "sol_usuario_secundario"=>"nullable|string|max:50",
            "sol_password_secundario"=>"nullable|string|max:50",
            "sol_certificado"=>"nullable|string|max:50",
            "path_certificado"=>"nullable|string|max:50",
            "integracion_db_externa"=>"nullable|boolean"
        ];
    }
}