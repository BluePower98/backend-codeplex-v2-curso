<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'cur_cursos';
    protected $primaryKey = "idempresa";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idcurso",
        "idespecialidad",
        "descripcion",
        "portada",
        "activo"
       
    ];
}   