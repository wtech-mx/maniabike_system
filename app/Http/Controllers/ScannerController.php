<?php

namespace App\Http\Controllers;

use App\Models\TallerProductos;
use App\Models\Taller;
use App\Models\Cliente;

use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index(){

        return view('admin.scanner.index');
    }


    public function search(Request $request){

        if($request->ajax()){
            $output="";

            $products=Taller::where('folio','LIKE','%'.$request->search."%")->get();

            // $cliente = $products->Cliente()->with('usuario')->get();

            if($products){

                foreach ($products as $key => $product) {
                $output.='<div class="row">'.
                '<div class="col-12">'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Folio:</strong>'.$product->folio.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Cliente:</strong>'.$product->Cliente->nombre.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Telefono:</strong>'.$product->Cliente->telefono.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Fecha:</strong>'.$product->fecha.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Bicicleta:</strong>  '.$product->marca.'-'.$product->modelo.'-'.$product->rodada.'</p>'.
                '<p class="respuesta_qr_info"><strong class="strong_qr_res">Observaciones:</strong>'.$product->observaciones.'</p>'.
                '</div>'.
                '</div>';

                }

                return Response($output);
            }
        }
    }

    public function store(request $request){

        return view('admin.scanner.index');
    }
}