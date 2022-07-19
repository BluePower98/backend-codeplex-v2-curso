<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table = 'lo_lineas';
    // protected $primaryKey = ["idempresa", "idtipoproducto", "idlinea"];
    protected $primaryKey = "idlinea";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idtipoproducto",
        "idlinea",
        "codigo",
        "descripcion"
    ];
}
