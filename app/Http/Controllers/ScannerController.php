<?php

namespace App\Http\Controllers;

use App\Models\TallerProductos;
use App\Models\Taller;
use App\Models\Cliente;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


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
            $taller_productos = TallerProductos::where('id_taller','=',$products->id)->get();


            if ($products->estatus == 1 ) {
                $products->estatus = 'Procesando';
            }elseif ($products->estatus == 2) {
                $products->estatus = 'En Espera';
            }elseif ($products->estatus == 3) {
                $products->estatus = 'Realizado';
            }elseif ($products->estatus == 4) {
                $products->estatus = 'Cancelado';
            }elseif ($products->estatus == 0) {
                $products->estatus = 'R ingresado';
            }elseif ($products->estatus == 5) {
                $products->estatus = 'Pagado';
            }

            //  foreach($taller_productos as $taller_producto){

            //  }

            if($products){
                $output.=
                '<div class="row">'.
                    '<div class="col-12">'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Folio:</strong>'.$products->folio.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Estatus:</strong>'.$products->estatus.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Cliente:</strong>'.$products->Cliente->nombre.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Telefono:</strong><a https://api.whatsapp.com/send?phone=521'.$products->Cliente->telefono.'"></a>'.$products->Cliente->telefono.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Fecha:</strong>'.$products->fecha.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Bicicleta:</strong>  '.$products->marca.'-'.$products->modelo.'-'.$products->rodada.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Observaciones:</strong>'.$products->observaciones.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Precio del servicio:</strong>'.$products->precio_servicio.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Saldo a favor:</strong>$'.$products->subtoral.'.0</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Total:</strong>$'.$products->total.'.0</p>'.
                    '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_service'.$products->id.'">Editar</button>'.
                    '</div>'.
                '</div>'.
                '<div class="modal fade" id="edit_modal_service'.$products->id.'" tabindex="-1" aria-labelledby="edit_modal_service'.$products->id.'Label" aria-hidden="true">'.
                '<div class="modal-dialog modal-dialog-centered">'.
                  '<div class="modal-content">'.
                    '<div class="modal-header">'.
                      '<h1 class="modal-title fs-5" id="exampleModalLabel">'.$products->Cliente->nombre.'</h1>'.
                      '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'.
                    '</div>'.
                    '<div class="modal-body">'.
                        '<form class="row" method="POST" action="'.route('scanner_servicio.edit', $products->id).'" >'.
                            '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                            '<input type="hidden" name="_method" value="PATCH">'.
                            '<div class="col-12">'.
                                '<p class="text-center">'.
                                '<a href="" target="_blank"><img src="'.asset('fotos_bicis/'.$products->foto1).'" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="'.asset('fotos_bicis/'.$products->foto2).'" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="'.asset('fotos_bicis/'.$products->foto3).'" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="'.asset('fotos_bicis/'.$products->foto4).'" style="width:90px;border-radius: 19px; margin-top: 1rem;"></a>'.
                                '</p>'.
                            '</div>'.
                            '<div class="col-12">'.
                            '<label for="name" class="form-label">Estatus</label>'.
                            '<select class="form-select" name="estado">'.
                                '<option selected >'.$products->estatus.'</option>'.
                                '<option value="1">Procesando</option>'.
                                '<option value="2">En Espera</option>'.
                                '<option value="3">Realizado</option>'.
                                '<option value="4">Cancelado</option>'.
                                '<option value="0">R ingresado</option>'.
                                '<option value="5">Pagado</option>'.
                            '</select>'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="price" class="form-label">Marca</label>'.
                            '<input type="text" class="form-control" id="marca" name="marca" value="'.$products->marca.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="sale_price" class="form-label">Modelo</label>'.
                            '<input type="text" class="form-control" id="modelo" name="modelo" value="'.$products->modelo.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="sku" class="form-label">Rodada</label>'.
                            '<input type="text" class="form-control" id="rodada" name="rodada" value="'.$products->rodada.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="Costo del servicio" class="form-label">Precio del servicio</label>'.
                            '<input type="number" class="form-control" id="precio_servicio" name="precio_servicio" value="'.$products->precio_servicio.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="Saldo a Favor" class="form-label">Saldo a Favor</label>'.
                            '<input type="number" disabled class="form-control" id="subtotal" name="subtotal" value="'.$products->subtotal.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="Total" class="form-label">Total</label>'.
                            '<input type="number" class="form-control" id="total" name="total" value="'.$products->total.'">'.
                            '</div>'.
                            '<button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>'.
                            '<button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>'.
                        '</form>'.
                    '</div>'.
                  '</div>'.
                '</div>';
                return Response($output);
            }
        }
    }



    public function edit_servicio(Request $request, $id){
        $servicio = Taller::find($id);
        $servicio->marca = $request->get('marca');
        $servicio->modelo = $request->get('modelo');
        $servicio->rodada = $request->get('rodada');
        $servicio->precio_servicio = $request->get('precio_servicio');
        $servicio->subtotal = $request->get('subtotal');
        $servicio->total = $request->get('total');
        $servicio->save(); // Guarda los cambios en la base de datos
        Alert::success('Servicio Editado', 'Se ha editado con exito');
        return redirect()->back();
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
                    '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_product'.$products['id'].'">Editar</button>'.
                    '</div>'.
                '</div>'.
                '<div class="modal fade" id="edit_modal_product'.$products['id'].'" tabindex="-1" aria-labelledby="edit_modal_product'.$products['id'].'Label" aria-hidden="true">'.
                '<div class="modal-dialog modal-dialog-centered">'.
                  '<div class="modal-content">'.
                    '<div class="modal-header">'.
                      '<h1 class="modal-title fs-5" id="exampleModalLabel">'.$products['name'].'</h1>'.
                      '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'.
                    '</div>'.
                    '<div class="modal-body">'.
                        '<form class="row" method="POST" action="'.route('scanner_product.edit', $products['id']).'" >'.
                            '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                            '<input type="hidden" name="_method" value="PATCH">'.
                            '<div class="col-12">'.
                                '<p class="text-center">'.
                                '<a href="'.$products['permalink'].'" target="_blank"><img src="'.$products['images'][0]->src.'" style="width:200px;"></a>'.
                                '</p>'.
                            '</div>'.
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
                            '<button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>'.
                            '<button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>'.
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
            'regular_price' => $products->price ,
            'sale_price' => $products->sale_price,
            'sku' => $products->sku,
            'stock_quantity' => $products->stock_quantity,
        ];

        $product = Product::update($id, $data);
        Alert::success('Producto Editado', 'Se ha editado con exito');
        return redirect()->back();
    }

    public function store(request $request){

        return view('admin.scanner.index');
    }
}
