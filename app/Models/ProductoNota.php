<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoNota extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'productos_notas';

    protected $fillable = [
        'id_product',
        'id_product_woo',
        'id_nota',
        'cantidad',
        'subtotal',
        'precio',
        'name',
    ];

    public function Nota()
    {
       return $this->belongsTo(Notas::class,'id_nota');
    }
}
