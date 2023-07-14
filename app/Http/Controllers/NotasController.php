<?php

namespace App\Http\Controllers;
use App\Models\Notas;
use App\Models\ProductoNota;

use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function edit($id){

        $notas = Notas::find($id)->first();
        $notas_productos = ProductoNota::where('id_nota','=',$id)->get();

        return view('admin.recibo.recibo',compact('notas','notas_productos'));
    }
}
