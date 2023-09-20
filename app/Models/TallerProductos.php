<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TallerProductos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'taller_productos';

    protected $fillable = [
        'id_taller',
        'producto',
        'id_product_woo',
        'price',
        'sku',
        'permalink',
    ];

    public function Taller()
    {
       return $this->belongsTo(Taller::class,'id_taller');
    }


}
