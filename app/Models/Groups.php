<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $table = 'cur_grupos';
    protected $primaryKey = "idempresa";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idgrupo",
        "idcurso",
        "nombre",
        "fecha_inicio",
        "fecha_fin",
        "duracion",
        "horario",
        "beneficios",
        "costo",
        "idmoneda",  
        "activo"  
       
    ];
}