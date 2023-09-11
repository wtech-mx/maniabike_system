<?php

namespace App\Http\Controllers;

use App\Models\TallerProductos;
use App\Models\Taller;
use App\Models\Cliente;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Barryvdh\DomPDF\Facade\Pdf;


class ScannerController extends Controller
{
    public function index(){

        return view('admin.scanner.index');
    }

    public function index_products(){
        return view('admin.scanner.index_product');
    }

    public function imprimir_ticket(Request $request, $sku){
        $products = Product::where('sku', '=', $sku)->first();

        $pdf = PDF::loadView('pdf.eticketa_productos',compact('products'));
        // Para cambiar la medida se deben pasar milimetros a putnos
        $pdf->setPaper([0, 0,141.732,70.8661], 'portrair');
        return $pdf->download('etiqueta_'.$sku.'.pdf');
    }

    public function search(Request $request){
        $servicios = Taller::where('folio', '=', $request->search)->first();
        if ($servicios) {
            return view('admin.scanner.search_servicio', ['servicios' => $servicios]);
        }

        return response()->json(['error' => 'No se encontraron datos']);
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

             $prb = $prb = $products['meta_data'];
             $clave_mayorista = null;
             $nombre_del_proveedor = null;
             $costo = null;
             $id_proveedor = null;


            foreach ($products['meta_data'] as $item) {
                if ($item->key === 'clave_mayorista') {
                    $clave_mayorista = $item->value;
                    break;
                }
            }
            foreach ($products['meta_data'] as $item) {
                if ($item->key === 'nombre_del_proveedor') {
                    $nombre_del_proveedor = $item->value;
                    break;
                }
            }
            foreach ($products['meta_data'] as $item) {
                if ($item->key === 'id_proveedor') {
                    $id_proveedor = $item->value;
                    break;
                }
            }
            foreach ($products['meta_data'] as $item) {
                if ($item->key === 'costo') {
                    $costo = $item->value;
                    break;
                }
            }

            if(isset($id_proveedor)){
                // tu código aquí si $id_proveedor está definido
              } else {
                $id_proveedor = "";
              }

              if(isset($nombre_del_proveedor)){
                // tu código aquí si $nombre_del_proveedor está definido
              } else {
                $nombre_del_proveedor = "";
              }

              if(isset($costo)){
                // tu código aquí si $costo está definido
              } else {
                $costo = 0;
              }

              if(isset($clave_mayorista)){
                // tu código aquí si $clave_mayorista está definido
              } else {
                $clave_mayorista = "";
              }

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
                                '<p class="text-center">'.
                                '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($products['sku'], 'C128', 3, 33, array(1, 1, 1), true) . '" alt="barcode" />'.
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
                            '<div class="col-6">'.
                            '<label for="costo" class="form-label">costo</label>'.
                            '<input type="text" class="form-control" id="costo" name="costo" value="'.$costo.'">'.
                            '</div>'.
                            '<div class="col-6">'.
                            '<label for="nombre_del_proveedor" class="form-label">Proveedor</label>'.
                            '<input type="text" class="form-control" id="nombre_del_proveedor" name="nombre_del_proveedor" value="'.$nombre_del_proveedor.'">'.
                            '</div>'.
                            '<div class="col-6">'.
                            '<label for="id_proveedor" class="form-label">Id Prove</label>'.
                            '<input type="text" class="form-control" id="id_proveedor" name="id_proveedor" value="'.$id_proveedor.'">'.
                            '</div>'.
                            '<div class="col-6">'.
                            '<label for="clave_mayorista" class="form-label">Mayoreo</label>'.
                            '<input type="text" class="form-control" id="clave_mayorista" name="clave_mayorista" value="'.$clave_mayorista.'">'.
                            '</div>'.
                            '<div class="col-7">'.
                            '<button id="save-btn" type="submit" class="btn btn-success mt-2"> Actualizar <i class="fa fa-save"></i></button>'.
                            '<button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal" style="margin-left: 1rem;"> Cerrar <i class="fa fa-close"></i></button>'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<a href="'.route('imprimir_eticketa.create',$products['sku']).'" target="_blank" class="btn btn-danger mt-2">  Imprimir <i class="fa fa-print"></i></a>'.
                            '</div>'.
                            '</div>'.
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
        $products->id_proveedor = $request->get('id_proveedor');
        $products->nombre_del_proveedor = $request->get('nombre_del_proveedor');
        $products->costo = $request->get('costo');
        $products->clave_mayorista = $request->get('clave_mayorista');

        $data       = [
            'name' => $products->name ,
            'price' => $products->price ,
            'regular_price' => $products->price ,
            'sale_price' => $products->sale_price,
            'sku' => $products->sku,
            'stock_quantity' => $products->stock_quantity,
            "meta_data" => [
                3 => [
                  "key"=> "id_proveedor",
                  "value"=> $products->id_proveedor,
                ],
                4 => [
                  "key"=> "nombre_del_proveedor",
                  "value"=> $products->nombre_del_proveedor,
                ],
                5 => [
                  "key"=> "costo",
                  "value"=> $products->costo,
                ],
                6 => [
                  "key"=> "clave_mayorista",
                  "value"=> $products->clave_mayorista,
                ]
              ]
        ];

        $product = Product::update($id, $data);
        Alert::success('Producto Editado', 'Se ha editado con exito');
        return redirect()->back();
    }

    public function store(request $request){

        return view('admin.scanner.index');
    }

    public function delete_product(Request $request,$id){
        $options = ['force' => true]; // Set force option true for delete permanently. Default value false

        $product = Product::delete($id, $options);
        Alert::warning('Producto Elimindo', 'Se ha eliminados con exito');
        return redirect()->back();
    }
}
