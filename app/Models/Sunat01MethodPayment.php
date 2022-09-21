<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sunat01MethodPayment extends Model
{
    use HasFactory;
    protected $table ='st_sunatt01_formas_pago';
    protected $primaryKey = 'idsunatt01';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable=[
        "idsunatt01",
        "descripcion",
        "descripcion_corta"
    ];
}
