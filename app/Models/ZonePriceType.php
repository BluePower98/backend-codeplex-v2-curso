<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZonePriceType extends Model
{
    protected $table = "lo_zonastipoprecios";
    protected $primaryKey = "IdTipoPrecio";
    public $timestamps = false;

    protected $fillable = [
        "Descripcion"
    ];
}
