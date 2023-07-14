<?php

namespace App\Http\Controllers;
use App\Models\Notas;
use App\Models\ProductoNota;
use Codexshaper\WooCommerce\Facades\Customer ;

use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function edit($id){

        $notas = Notas::find($id);
        $notas_productos = ProductoNota::where('id_nota','=',$id)->get();

        $customer = Customer::where('id','=',$notas->id_client)->first();
        return view('admin.recibo.recibo',compact('notas','notas_productos','customer'));
    }
}
