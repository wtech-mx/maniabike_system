<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codexshaper\WooCommerce\Facades\WooCommerce;
use RealRashid\SweetAlert\Facades\Alert;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;


class WooController extends Controller
{
    public function index(request $request){

        $productos = WooCommerce::all('products');
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $productosPaginados = new LengthAwarePaginator(
            array_slice($productos, ($currentPage - 1) * $perPage, $perPage),
            count($productos),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('admin.productos.index', compact('productosPaginados','productos'));
    }

    public function search(Request $request)
    {
        $q = $request->input('buscar');
        $productos = Product::where('name', 'LIKE', '%'.$q.'%')->get();

        dd($productos);

        return view('admin.productos.index', compact('productos'));
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