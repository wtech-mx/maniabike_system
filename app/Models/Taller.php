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
        'color_2',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'cadena',
        'otro',
        'llanta_d',
        'llanta_t',
        'frenos_d',
        'frenos_t',
        'camara_t',
        'camara_d',
        'observaciones',
        'eje',
        'mandos',
        'total',
        'resto',
        'metodo_pago',
        'firma',
        'folio',
        'servicio',
        'subtotal',
    ];

    public function Cliente()
    {
       return $this->belongsTo(Cliente::class,'id_cliente');
    }
}
