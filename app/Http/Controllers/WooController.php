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
                $output2 .=
                '<tr class"text-white">'.
                    '<td class="text-white text-left">'.$product->name.'</td>'.
                    '<td class="text-white text-center">'.$product->sku.'</td>'.
                    '<td class="text-white text-center">'.$product->sale_price.'</td>'.
                    '<td class="text-white text-center">'.$product->stock_quantity.'</td>'.
                    '<td class="text-white text-center">'.$product->price.'</td>'.
                    '<td class="text-white text-center">'.
                        '<a class="btn btn-sm btn-success"   href="">'.
                            '<i class="fa fa-fw fa-edit">'.
                        '</i>'.
                        '</a>'.
                    '</td>'.
                '</tr>';
                }

                $output =
                '<div class="table-responsive">'.
                '<table class="table table-flush" id="myTable">'.
                    '<thead class="text-center">'.
                        '<tr class="tr_checkout text-white">'.
                        '<th class="text-left">Nombre</th>'.
                        '<th class="text-center">Sku</th>'.
                        '<th class="text-center">Precio</th>'.
                        '<th class="text-center">Stock</th>'.
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
