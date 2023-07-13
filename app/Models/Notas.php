<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'notas';

    protected $fillable = [
        'fecha',
        'id_product',
        'id_client',
        'metodo_pago',
        'tipo',
        'descuento',
        'subtotal',
        'total',
        'comentario',
        'comprobante',
    ];
}
