<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosAlumnos extends Model
{
    use HasFactory;
    protected $table = "cursos_alumnos";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_curso',
        'id_usuario',
    ];

    public function Curso()
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
