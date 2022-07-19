<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = "lo_inventarios";
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idalmacen",
        "idsucursal",
        "idproducto",
        "idmedida",
        "codigoinventario",
        "lote",
        "fechavencimiento",
        "fecha",
        "iniciarkardex",
        "tipo",
        "idmoneda",
        "costosinigv",
        "stocksistema",
        "stkinventariado",
        "idtipoproducto",
        "xls",
        "otra_medida_control",
        "correlativo"
    ];
}
