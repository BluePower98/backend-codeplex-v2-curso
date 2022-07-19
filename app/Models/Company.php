<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'zg_empresas';
    protected $primaryKey = 'idempresa';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idrubro",
        "ruc",
        "nombrerazon",
        "nombrecomercial",
        "nombrecorto",
        "direccion",
        "ubigeo",
        "telefono",
        "email",
        "webpage",
        "activo",
        "logo",
        "imagen01",
        "imagen02",
        "imagen03",
        "ageret",
        "ageper",
        "carritocompras"
    ];
}
