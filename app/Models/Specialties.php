<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialties extends Model
{
    protected $table = 'cur_especialidades';
    protected $primaryKey = "idempresa";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idespecialidad",
        "descripcion",
        "portada",
        "activo"
       
    ];
}