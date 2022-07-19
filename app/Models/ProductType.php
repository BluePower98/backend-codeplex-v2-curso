<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = "zg_tipoproductos";
    protected $primaryKey = "idtipoproducto";
    public $timestamps = false;

    protected $fillable = [
        "descripcion"
    ];
}
