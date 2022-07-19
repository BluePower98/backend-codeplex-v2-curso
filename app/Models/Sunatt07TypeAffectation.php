<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sunatt07TypeAffectation extends Model
{
    protected $table = "st_sunatt07_tipo_afectaciones";
    protected $primaryKey = "idsunatt07";
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        "idsunatt07",
        "descripcion",
        "mostrar",
    ];
}
