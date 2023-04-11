<?php

namespace App\Http\Controllers;

use App\Models\TallerProductos;
use App\Models\Taller;
use App\Models\Cliente;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index(){

        return view('admin.scanner.index');
    }

    public function index_products(){
        return view('admin.scanner.index_product');
    }


    public function search(Request $request){


        if($request->ajax()){
            $output="";

            $products = Taller::where('folio', '=', $request->search)->first();

            if($products){
                $output.='<div class="row">'.
                '<div class="col-12">'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Folio:</strong>'.$products->folio.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Cliente:</strong>'.$products->Cliente->nombre.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Telefono:</strong>'.$products->Cliente->telefono.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Fecha:</strong>'.$products->fecha.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Bicicleta:</strong>  '.$products->marca.'-'.$products->modelo.'-'.$products->rodada.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Observaciones:</strong>'.$products->observaciones.'</p>'.
                '</div>'.
                '</div>';
                return Response($output);
            }
        }
    }

    public function search_product(Request $request){

        if($request->ajax()){
            $output="";
            $products = Product::where('sku', '=', $request->search)->first();
            // $cliente = $products->Cliente()->with('usuario')->get();
            if($products){
                $output.='<div class="row">'.
                '<div class="col-12">'.
                '<a href="'.$products['permalink'].'" target="_blank"><img src="'.$products['images'][0]->src.'" style="width:100px;"></a>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Nombre:</strong>'.$products['name'].'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Precio:</strong>'.$products['price'].'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Promocion:</strong>'.$products['sale_price'].'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">SKU:</strong>'.$products['sku'].'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Stock:</strong>'.$products['stock_quantity'].'</p>'.
                // '<p class="respuesta_qr_info"><strong class="strong_qr_res">Clave Mayoreo:</strong>'.$products['meta_data'][22]->value.'</p>'.
                '</div>'.
                '</div>';
                return Response($output);
            // }else{
            //     $output.='<div class="row">'.
            //     '<div class="col-12">'.
            //     '<p class="respuesta_qr_info"><strong class="strong_qr_res">Nombre:</strong>'.$products['name'].'</p>'.
            //     '<p class="respuesta_qr_info"><strong class="strong_qr_res">Precio:</strong>'.$products['price'].'</p>'.
            //     '<p class="respuesta_qr_info"><strong class="strong_qr_res">Promocion:</strong>'.$products['sale_price'].'</p>'.
            //     '<p class="respuesta_qr_info"><strong class="strong_qr_res">SKU:</strong>'.$products['sku'].'</p>'.
            //     '<p class="respuesta_qr_info"><strong class="strong_qr_res">Stock:</strong>'.$products['stock_quantity'].'</p>'.
            //     // '<p class="respuesta_qr_info"><strong class="strong_qr_res">Clave Mayoreo:</strong>'.$products['meta_data'][22]->value.'</p>'.
            //     '</div>'.
            //     '</div>';
            //     return Response($output);
            // }
            }
        }
    }

    public function store(request $request){

        return view('admin.scanner.index');
    }
}
