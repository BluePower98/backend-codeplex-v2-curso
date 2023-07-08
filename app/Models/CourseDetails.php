<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetails extends Model
{
    protected $table = 'cur_cursos_detalles';
    protected $primaryKey = "idempresa";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "iddetallecurso",
        "idcurso",
        "idespecialidad",
        "idinstructor",
        "detalledecurso",
        "lección",
        "cuestionarios",
        "estudiantes",
        "duración",
        "certificado",
        "whassap",
        "fotos",
        "activo"
       
    ];
}   