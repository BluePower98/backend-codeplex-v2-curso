<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZonePrice extends Model
{
    protected $table = "lo_zonasprecios";
    protected $primaryKey = null;
    public $incrementing = null;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idproducto",
        "idprecio",
        "idzona",
        "idmedida",
        "idtipoprecio",
        "codigoBarra",
        "precioventa",
        "cantidadminven",
        "incluidoigv",
        "defecto",
        "descripcion",
        "xls",
        "peso_kg",
        "idpropiedad1",
        "idpropiedad2",
        "idpropiedad3",
        "costo",
        "utilidad_porcen",
        "precio_minimo",
    ];
}
