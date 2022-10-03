<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Alumnos extends Model 
{
    protected $table = 'cur_alumnos';
    protected $primaryKey = "idempresa";
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        "idempresa",
        "idalumno",
        "apellidos",
        "nombres",
        "foto",
        "fecha_registro",
        "activo",
    ];
}