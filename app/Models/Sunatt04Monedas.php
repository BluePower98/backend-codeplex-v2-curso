<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sunatt04Monedas extends Model
{
    use HasFactory;
    protected $table = 'st_sunatt04_monedas';
    
    protected $primaryKey = "idmoneda";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable=[
        "idmoneda",
        "descripcion",
        "simbolo",
        "activo",
        "codigo_sunat"
    ];
}
