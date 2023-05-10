<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codexshaper\WooCommerce\Facades\WooCommerce;
use RealRashid\SweetAlert\Facades\Alert;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Session;


class WooController extends Controller
{
    public function index(request $request){
        return view('admin.productos.index');
    }

    public function search(Request $request)
    {
        $buscar = $request->input('buscar');

        $page = $request->input('page', 1);
        $perPage = 25; // Número de productos por página que quieres obtener
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://www.maniabikes.com.mx/inicio/wp-json/wc/v3/products', [
            'auth' => ['ck_669c65e13b042664bbf29cc9dd04f86b33b8f568', 'cs_4e770f2fa9f7bc9f5aca5d9bb5c3cda3478fea9a'],
            'query' => [
                'search' => $buscar,
                'page' => $page,
                'per_page' => $perPage,
            ],
        ]);
        $total = $response->getHeaderLine(config('woocommerce.header_total'));

        $products = json_decode($response->getBody());

        //dd($products);
        $output = "";
        $output2 = "";
        if($request->ajax()){

            if ($products) {
                foreach ($products as $product) {

                    // if($product->meta_data[5]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[5]->value;
                    //     $nombre_del_proveedor = $product->meta_data[6]->value;
                    //     $costo = $product->meta_data[7]->value;
                    //     $clave_mayorista = $product->meta_data[8]->value;
                    // }elseif($product->meta_data[6]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[6]->value;
                    //     $nombre_del_proveedor = $product->meta_data[7]->value;
                    //     $costo = $product->meta_data[8]->value;
                    //     $clave_mayorista = $product->meta_data[9]->value;

                    // }elseif($product->meta_data[7]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[7]->value;
                    //     $nombre_del_proveedor = $product->meta_data[8]->value;
                    //     $costo = $product->meta_data[9]->value;
                    //     $clave_mayorista = $product->meta_data[10]->value;

                    // }elseif($product->meta_data[16]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[16]->value;
                    //     $nombre_del_proveedor = $product->meta_data[18]->value;
                    //     $costo = $product->meta_data[20]->value;
                    //     $clave_mayorista = $product->meta_data[22]->value;

                    // }elseif($product->meta_data[17]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[17]->value;
                    //     $nombre_del_proveedor = $product->meta_data[19]->value;
                    //     $costo = $product->meta_data[21]->value;
                    //     $clave_mayorista = $product->meta_data[23]->value;

                    // }elseif($product->meta_data[18]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[18]->value;
                    //     $nombre_del_proveedor = $product->meta_data[20]->value;
                    //     $costo = $product->meta_data[22]->value;
                    //     $clave_mayorista = $product->meta_data[24]->value;

                    // }elseif($product->meta_data[19]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[19]->value;
                    //     $nombre_del_proveedor = $product->meta_data[21]->value;
                    //     $costo = $product->meta_data[23]->value;
                    //     $clave_mayorista = $product->meta_data[25]->value;

                    // }elseif($product->meta_data[20]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[20]->value;
                    //     $nombre_del_proveedor = $product->meta_data[22]->value;
                    //     $costo = $product->meta_data[24]->value;
                    //     $clave_mayorista = $product->meta_data[26]->value;

                    // }elseif($product->meta_data[21]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[21]->value;
                    //     $nombre_del_proveedor = $product->meta_data[23]->value;
                    //     $costo = $product->meta_data[25]->value;
                    //     $clave_mayorista = $product->meta_data[27]->value;

                    // }elseif($product->meta_data[22]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[22]->value;
                    //     $nombre_del_proveedor = $product->meta_data[24]->value;
                    //     $costo = $product->meta_data[26]->value;
                    //     $clave_mayorista = $product->meta_data[28]->value;

                    // }elseif($product->meta_data[23]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[23]->value;
                    //     $nombre_del_proveedor = $product->meta_data[25]->value;
                    //     $costo = $product->meta_data[27]->value;
                    //     $clave_mayorista = $product->meta_data[29]->value;

                    // }elseif($product->meta_data[24]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[24]->value;
                    //     $nombre_del_proveedor = $product->meta_data[26]->value;
                    //     $costo = $product->meta_data[28]->value;
                    //     $clave_mayorista = $product->meta_data[30]->value;

                    // }elseif($product->meta_data[25]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[25]->value;
                    //     $nombre_del_proveedor = $product->meta_data[27]->value;
                    //     $costo = $product->meta_data[29]->value;
                    //     $clave_mayorista = $product->meta_data[31]->value;

                    // }elseif($product->meta_data[26]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[26]->value;
                    //     $nombre_del_proveedor = $product->meta_data[28]->value;
                    //     $costo = $product->meta_data[30]->value;
                    //     $clave_mayorista = $product->meta_data[32]->value;

                    // }elseif($product->meta_data[27]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[27]->value;
                    //     $nombre_del_proveedor = $product->meta_data[29]->value;
                    //     $costo = $product->meta_data[31]->value;
                    //     $clave_mayorista = $product->meta_data[33]->value;

                    // }elseif($product->meta_data[28]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[28]->value;
                    //     $nombre_del_proveedor = $product->meta_data[30]->value;
                    //     $costo = $product->meta_data[32]->value;
                    //     $clave_mayorista = $product->meta_data[34]->value;

                    // }elseif($product->meta_data[29]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[29]->value;
                    //     $nombre_del_proveedor = $product->meta_data[31]->value;
                    //     $costo = $product->meta_data[33]->value;
                    //     $clave_mayorista = $product->meta_data[35]->value;

                    // }elseif($product->meta_data[30]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[30]->value;
                    //     $nombre_del_proveedor = $product->meta_data[32]->value;
                    //     $costo = $product->meta_data[34]->value;
                    //     $clave_mayorista = $product->meta_data[36]->value;

                    // }elseif($product->meta_data[31]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[31]->value;
                    //     $nombre_del_proveedor = $product->meta_data[33]->value;
                    //     $costo = $product->meta_data[35]->value;
                    //     $clave_mayorista = $product->meta_data[37]->value;

                    // }elseif($product->meta_data[32]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[32]->value;
                    //     $nombre_del_proveedor = $product->meta_data[34]->value;
                    //     $costo = $product->meta_data[36]->value;
                    //     $clave_mayorista = $product->meta_data[38]->value;

                    // }elseif($product->meta_data[33]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[33]->value;
                    //     $nombre_del_proveedor = $product->meta_data[35]->value;
                    //     $costo = $product->meta_data[37]->value;
                    //     $clave_mayorista = $product->meta_data[39]->value;

                    // }elseif($product->meta_data[34]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[34]->value;
                    //     $nombre_del_proveedor = $product->meta_data[36]->value;
                    //     $costo = $product->meta_data[38]->value;
                    //     $clave_mayorista = $product->meta_data[40]->value;

                    // }elseif($product->meta_data[35]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[35]->value;
                    //     $nombre_del_proveedor = $product->meta_data[37]->value;
                    //     $costo = $product->meta_data[39]->value;
                    //     $clave_mayorista = $product->meta_data[41]->value;
                    // }elseif($product->meta_data[35]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[35]->value;
                    //     $nombre_del_proveedor = $product->meta_data[37]->value;
                    //     $costo = $product->meta_data[39]->value;
                    //     $clave_mayorista = $product->meta_data[41]->value;
                    // }elseif($product->meta_data[36]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[36]->value;
                    //     $nombre_del_proveedor = $product->meta_data[38]->value;
                    //     $costo = $product->meta_data[40]->value;
                    //     $clave_mayorista = $product->meta_data[42]->value;
                    // }elseif($product->meta_data[37]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[37]->value;
                    //     $nombre_del_proveedor = $product->meta_data[39]->value;
                    //     $costo = $product->meta_data[41]->value;
                    //     $clave_mayorista = $product->meta_data[43]->value;
                    // }elseif($product->meta_data[114]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[114]->value;
                    //     $nombre_del_proveedor = $product->meta_data[115]->value;
                    //     $costo = $product->meta_data[13]->value;
                    //     $clave_mayorista = $product->meta_data[15]->value;
                    // }elseif($product->meta_data[118]->key == "id_proveedor"){
                    //     $id_proveedor = $product->meta_data[118]->value;
                    //     $nombre_del_proveedor = $product->meta_data[119]->value;
                    //     $costo = $product->meta_data[114]->value;
                    //     $clave_mayorista = $product->meta_data[120]->value;
                    // }

                    // if(isset($id_proveedor)){
                    //     // tu código aquí si $id_proveedor está definido
                    //   } else {
                    //     $id_proveedor = "";
                    //   }

                    //   if(isset($nombre_del_proveedor)){
                    //     // tu código aquí si $nombre_del_proveedor está definido
                    //   } else {
                    //     $nombre_del_proveedor = "";
                    //   }

                    //   if(isset($costo)){
                    //     // tu código aquí si $costo está definido
                    //   } else {
                    //     $costo = 0;
                    //   }

                    //   if(isset($clave_mayorista)){
                    //     // tu código aquí si $clave_mayorista está definido
                    //   } else {
                    //     $clave_mayorista = "";
                    //   }
                $output2 .=
                '<tr class"text-white">'.
                    '<td class="text-white text-center">'.$product->stock_quantity.'</td>'.
                    '<td class="text-white text-left">'.$product->name.'</td>'.
                    '<td class="text-white text-center">'.$product->sku.'</td>'.
                    '<td class="text-white text-center">$'.$product->price.'.0</td>'.
                    '<td class="text-white text-center">'.
                        '<a class="btn btn-sm btn-success"  data-bs-toggle="modal" type="button" data-bs-target="#edit_modal_product'.$product->id.'">'.
                            '<i class="fa fa-fw fa-edit">'.
                        '</i>'.
                        '</a>'.
                    '</td>'.
                '</tr>'.
                '<div class="modal fade" id="edit_modal_product'.$product->id.'" tabindex="-1" aria-labelledby="edit_modal_product'.$product->id.'Label" aria-hidden="true">'.
                '<div class="modal-dialog modal-dialog-centered">'.
                  '<div class="modal-content">'.
                    '<div class="modal-header">'.
                      '<h1 class="modal-title fs-5" id="exampleModalLabel">'.$product->name.'</h1>'.
                      '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'.
                    '</div>'.
                    '<div class="modal-body row">'.
                        '<form class="row" method="POST" action="'.route('scanner_product.edit', $product->id).'" >'.
                            '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                            '<input type="hidden" name="_method" value="PATCH">'.
                            '<div class="col-12">'.
                                '<p class="text-center">'.
                                '<a href="'.$product->permalink.'" target="_blank"><img src="" style="width:200px;"></a>'.
                                '</p>'.
                            '</div>'.
                            '<div class="col-12">'.
                            '<label for="name" class="form-label">Nombre</label>'.
                            '<input type="text" class="form-control" id="name" name="name" value="'.$product->name.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="price" class="form-label">Precio</label>'.
                            '<input type="number" class="form-control" id="price" name="price" value="'.$product->price.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="sale_price" class="form-label">Promoción</label>'.
                            '<input type="number" class="form-control" id="sale_price" name="sale_price" value="'.$product->sale_price.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="sku" class="form-label">SKU</label>'.
                            '<input type="text" class="form-control" id="sku" name="sku" value="'.$product->sku.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="stock_quantity" class="form-label">Stock</label>'.
                            '<input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="'.$product->stock_quantity.'">'.
                            '</div>'.
                            // '<div class="col-6">'.
                            // '<label for="costo" class="form-label">costo</label>'.
                            // '<input type="text" class="form-control" id="costo" name="costo" value="'.$costo.'">'.
                            // '</div>'.
                            // '<div class="col-6">'.
                            // '<label for="nombre_del_proveedor" class="form-label">Proveedor</label>'.
                            // '<input type="text" class="form-control" id="nombre_del_proveedor" name="nombre_del_proveedor" value="'.$nombre_del_proveedor.'">'.
                            // '</div>'.
                            // '<div class="col-6">'.
                            // '<label for="id_proveedor" class="form-label">Id Prove</label>'.
                            // '<input type="text" class="form-control" id="id_proveedor" name="id_proveedor" value="'.$id_proveedor.'">'.
                            // '</div>'.
                            // '<div class="col-6">'.
                            // '<label for="clave_mayorista" class="form-label">Mayoreo</label>'.
                            // '<input type="text" class="form-control" id="clave_mayorista" name="clave_mayorista" value="'.$clave_mayorista.'">'.
                            // '</div>'.
                            '<button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>'.
                            '<button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>'.
                        '</form>'.
                    '</div>'.
                  '</div>'.
                '</div>';
                }

                $output =
                '<div class="table-responsive">'.
                '<table class="table table-flush" id="myTable">'.
                    '<thead class="text-center">'.
                        '<tr class="tr_checkout text-white">'.
                        '<th class="text-center">Stock</th>'.
                        '<th class="text-left">Nombre</th>'.
                        '<th class="text-center">Sku</th>'.
                        '<th class="text-center">Precio</th>'.
                        '<th class="text-center">Acciones</th>'.
                        '</tr>'.
                    '</thead>'.
                    '<tbody>'.
                    $output2 .
                    '</tbody>'.
                '</table>'.
                '</div>';
            }
        }
        return response()->json($output);

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'regular_price' => 'required',
            'description' => '',
            'sku' => '',
            'stock_quantity' => '',
        ]);

        $name = $request->get('name');
        $description = $request->get('description');
        $descripcion_corta = substr($description, 0, 100) . "... (ver más)";
        $price = $request->get('regular_price');
        $regular_price = $price;
        $sku = $request->get('sku');
        $stock_quantity = $request->get('stock_quantity');
        $id_proveedor = $request->get('id_proveedor');
        $nombre_del_proveedor = $request->get('nombre_del_proveedor');
        $costo = $request->get('costo');
        $clave_mayorista = $request->get('clave_mayorista');

        $dominio = $request->getHost();
        if($dominio == 'taller.maniabikes.com.mx'){
            $fotos_bicis = base_path('../public_html/taller/productos_fotos');

        }else{
            $fotos_bicis = public_path() . '/productos_fotos';
        }

        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();

            $file->move($path, $fileName);
            $ruta_completa = 'https://taller.maniabikes.com.mx/productos_fotos/'.$fileName;
        }
        $data = [
            'name' => $name,
            'type' => 'simple',
            'price' => $price,
            'regular_price' => $price,
            'sku' => $sku,
            "manage_stock" => true,
            'stock_quantity' => $stock_quantity,
            'description' => $description,
            'short_description' => $descripcion_corta,
            'images' => [
                [
                    'src' => $ruta_completa
                ],
            ],
            "meta_data" => [
                0 => [
                  "key"=> "_wp_page_template",
                  "value"=> "default",
                ],
                1 => [
                  "key"=> "wpp_send_notification_for_new_post",
                  "value"=> "1",
                ],
                2 => [
                  "key"=> "webpushr_notification_preview",
                  "value"=> "0",
                ],
                3 => [
                  "key"=> "id_proveedor",
                  "value"=> $id_proveedor,
                ],
                4 => [
                  "key"=> "nombre_del_proveedor",
                  "value"=> $nombre_del_proveedor,
                ],
                5 => [
                  "key"=> "costo",
                  "value"=> $costo,
                ],
                6 => [
                  "key"=> "clave_mayorista",
                  "value"=> $clave_mayorista,
                ]
              ]
        ];

        $newProduct = Product::create($data);

         Alert::success('Producto creado', 'Se ha guardado con exito');
         return redirect()->back();

    }
}
