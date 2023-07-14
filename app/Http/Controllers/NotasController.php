<?php

namespace App\Http\Controllers;
use App\Models\Notas;
use App\Models\ProductoNota;
use Codexshaper\WooCommerce\Facades\Product;

use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function edit($id)
    {
        $notas = Notas::find($id)->get();
        $notas_productos = ProductoNota::where('id_nota', $id)->get();

        $productos = Product::whereIn('id', $notas_productos->pluck('id_product_woo'))->get();

        dd($productos);

        return view('admin.recibo.recibo', compact('notas', 'notas_productos', 'productos'));
    }

}
