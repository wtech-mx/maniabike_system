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
        'cantidad',
        'subtotal',
        'precio',
        'name',
    ];
}
