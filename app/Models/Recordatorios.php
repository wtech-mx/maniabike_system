<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordatorios extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'recordatorios';

    protected $fillable = [
        'cliente',
        'descripcion',
        'fecha',
        'estatus',
    ];
}
