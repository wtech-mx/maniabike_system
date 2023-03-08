<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'taller';

    protected $fillable = [
        'id_cliente',
        'marca',
        'estatus',
        'modelo',
        'rodada',
        'tipo',
        'color',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'cadena',
        'sprock',
        'multiplicacion',
        'otro',
        'llanta_d',
        'llanta_t',
        'frenos_d',
        'frenos_t',
        'observaciones',
        'eje',
        'camaras',
        'mandos',
        'total',
        'resto',
        'metodo_pago',
    ];
}
