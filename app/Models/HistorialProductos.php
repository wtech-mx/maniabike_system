<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialProductos extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'historial_productos';

    protected $fillable = [
        'id_producto',
        'accion',
        'cantidad',
        'id_user',
    ];

    public function Usuario()
    {
       return $this->belongsTo(User::class,'id_user');
    }
}
