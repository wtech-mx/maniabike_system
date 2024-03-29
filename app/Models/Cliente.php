<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'id_user',
    ];

    public function Usuario()
    {
       return $this->belongsTo(User::class,'id_user');
    }
}
