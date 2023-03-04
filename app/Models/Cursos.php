<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;
    protected $table = "cursos";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'foto',
        'fecha_inicial',
        'hora_inicial',
        'fecha_final',
        'hora_final',
        'categoria',
        'modalidad',
        'id_lugar',
        'objetivo',
        'temario',
        'sep',
        'unam',
        'stps',
        'redconocer',
        'imnas',
        'recurso',
        'informacion',
        'clase_grabada',
        'destacado',
    ];

}
