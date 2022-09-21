<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;
    protected $table = 'lo_parametros';
    
    protected $primaryKey = "idempresa";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable=[
        "idempresa",
        "logo",
        "msj_comprobante",
        "msj_otros",
        "pie_comprobante",
        "nro_cuentas",
        "formato_impresion",
        "otros_doc_logo",
        "envio",
        "tipo",
        "usuario",
        "password",
        "certificado",
        "espaciodias",
        "modulo",
        "idplactatipo",
        "canaut",
        "idtipodocumento",
        "idproducto",
        "envio_automatic_fac",
        "optica_codigo_barras",
        "aperturar_caja_ventas",
        "acreditar_ventas",
        "actualmente_enviando",
        "nombre_guia_pre_impresa",
        "pag_margin_left_80mm",
        "text_size_80mm",
        "impresion_dsto",
        "centrar_logo",
        "idformapago",
        "envio_individual_boletas",
        "tiempo_sesion",
        "ver_data_empresa",
        "vista_previa",
        "imprimir",
        "vista_previa_movil",
        "pendiente_pago",
        "pendiente_pago_sicovi",
        "sell_multiple_products"
    ];
}
