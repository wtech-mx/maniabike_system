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
                $output.=
                '<div class="row">'.
                    '<div class="col-12">'.
                    '<a href="'.$products['permalink'].'" target="_blank"><img src="'.$products['images'][0]->src.'" style="width:100px;"></a>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Nombre:</strong>'.$products['name'].'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Precio:</strong>'.$products['price'].'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Promocion:</strong>'.$products['sale_price'].'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">SKU:</strong>'.$products['sku'].'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Stock:</strong>'.$products['stock_quantity'].'</p>'.
                    '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_product'.$products['id'].'">'.
                    '</div>'.
                '</div>'.
                '<div class="modal fade" id="edit_modal_product'.$products['id'].'" tabindex="-1" aria-labelledby="edit_modal_product'.$products['id'].'Label" aria-hidden="true">'.
                '<div class="modal-dialog modal-dialog-centered">'.
                  '<div class="modal-content">'.
                    '<div class="modal-header">'.
                      '<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>'.
                      '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'.
                    '</div>'.
                    '<div class="modal-body">'.
                    '<form class="row" method="POST" action="'.route('scanner_product.edit', $products['id']).'" >'.
                    '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                    '<input type="hidden" name="_method" value="PATCH">'.
                    '<div class="col-12">'.
                    '<label for="name" class="form-label">Nombre</label>'.
                    '<input type="text" class="form-control" id="name" name="name" value="'.$products['name'].'">'.
                    '</div>'.
                    '<div class="col-3">'.
                    '<label for="price" class="form-label">Precio</label>'.
                    '<input type="number" class="form-control" id="price" name="price" value="'.$products['price'].'">'.
                    '</div>'.
                    '<div class="col-3">'.
                    '<label for="sale_price" class="form-label">Promoción</label>'.
                    '<input type="number" class="form-control" id="sale_price" name="sale_price" value="'.$products['sale_price'].'">'.
                    '</div>'.
                    '<div class="col-3">'.
                    '<label for="sku" class="form-label">SKU</label>'.
                    '<input type="text" class="form-control" id="sku" name="sku" value="'.$products['sku'].'">'.
                    '</div>'.
                    '<div class="col-3">'.
                    '<label for="stock_quantity" class="form-label">Stock</label>'.
                    '<input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="'.$products['stock_quantity'].'">'.
                    '</div>'.
                    '<button id="save-btn" type="submit" class="btn btn-primary">Guardar cambios</button>'.
                '</form>'.
                    '</div>'.
                  '</div>'.
                '</div>';
                return Response($output);
            }
        }
    }

    public function edit_product(Request $request,$id)
    {
        $products = Product::find($id);
        $products->name = $request->get('name');
        $products->price = $request->get('price');
        $products->sale_price = $request->get('sale_price');
        $products->sku = $request->get('sku');
        $products->stock_quantity = $request->get('stock_quantity');

        $data       = [
            'name' => $products->name ,
            'price' => $products->price ,
            'sale_price' => $products->sale_price,
            'sku' => $products->sku,
            'stock_quantity' => $products->stock_quantity,
        ];

        $product = Product::update($id, $data);

        return redirect()->back()->with('success', 'your message,here');
    }

    public function store(request $request){

        return view('admin.scanner.index');
    }
}
