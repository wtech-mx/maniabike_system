<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosTickets extends Model
{
    use HasFactory;
    protected $table = "cursos_tickets";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_curso',
        'nombre',
        'descripcion',
        'precio',
        'descuento',
        'fecha_inicial',
        'fecha_final',
    ];
}
