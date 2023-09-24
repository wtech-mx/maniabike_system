<?php

namespace App\Http\Controllers;

use App\Models\HistorialProductos;
use Illuminate\Http\Request;

use Codexshaper\WooCommerce\Facades\WooCommerce;
use RealRashid\SweetAlert\Facades\Alert;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Session;
use App\Services\WooCommerceService;


class WooController extends Controller
{
    public function index(request $request){
        return view('admin.productos.index');
    }

    public function search2(Request $request){
        $buscar = $request->input('buscar');
        $page = $request->input('page', 1);
        $perPage = 100;

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
        $product = json_decode($response->getBody());

        return view('admin.productos.busqueda', compact('product'));
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


        $output = "";
        $output2 = "";
        if($request->ajax()){
            if ($products) {
                foreach ($products as $product) {
                    // dd($product->images[0]->src);
                    if (isset($product->images[0])) {
                        $imageSrc = $product->images[0]->src;
                        //dd($product->meta_data[0]);

                        $clave_mayorista = null;
                        $nombre_del_proveedor = null;
                        $costo = null;
                        $id_proveedor = null;

                       foreach ($product->meta_data as $item) {
                           if ($item->key === 'clave_mayorista') {
                               $clave_mayorista = $item->value;
                               break;
                           }
                       }
                       foreach ($product->meta_data as $item) {
                           if ($item->key === 'nombre_del_proveedor') {
                               $nombre_del_proveedor = $item->value;
                               break;
                           }
                       }
                       foreach ($product->meta_data as $item) {
                           if ($item->key === 'id_proveedor') {
                               $id_proveedor = $item->value;
                               break;
                           }
                       }
                       foreach ($product->meta_data as $item) {
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

                $output2 .=
                '<tr class"text-white">'.
                    '<td class="text-white text-left" style="font-size:11px;"><input type="checkbox" name="productos_seleccionados[]" value="'.$product->sku.'"></td>'.
                    '<td class="text-white text-center" style="font-size:11px;"><a data-bs-toggle="modal" type="button" data-bs-target="#edit_modal_product'.$product->id.'" style="font-size:11px;"><img src="'.$imageSrc.'" style="width:50px;"></br>'.$product->stock_quantity.'</a></td>'.
                    '<td class="text-white text-left" style="font-size:11px;">'.$nombre_del_proveedor.'</td>'.
                    '<td class="text-white text-left" style="font-size:11px;">'.$product->name.'</td>'.
                    '<td class="text-white text-center" style="font-size:11px;">'.$product->sku.'</td>'.
                    '<td class="text-white text-center" style="font-size:11px;">$'.$product->price.'.0</td>'.
                    '<td class="text-white text-center" style="font-size:11px;">'.
                        '<form class="row" style="display: inline-block;margin-left: 10px;" method="POST" action="'.route('scanner_product.delete', $product->id).'" >'.
                        '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                        '<input type="hidden" name="_method" value="DELETE">'.
                        '<button  class="btn btn-sm btn-danger"  type="submit">'.
                        '<i class="fa fa-fw fa-trash"></i>'.
                        '</form>'.
                        '</button >'.
                    '</td>'.
                '</tr>'.
                '<div class="modal fade" id="edit_modal_product'.$product->id.'" tabindex="-1" aria-labelledby="edit_modal_product'.$product->id.'Label" aria-hidden="true">'.
                '<div class="modal-dialog modal-dialog-centered">'.
                  '<div class="modal-content">'.
                    '<div class="modal-header">'.
                      '<h3 class="modal-title fs-5" id="exampleModalLabel">'.$product->name.'</h3>'.
                      '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'.
                    '</div>'.
                    '<div class="modal-body row">'.
                        '<form class="row" method="POST" action="'.route('scanner_product.edit', $product->id).'" >'.
                            '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                            '<input type="hidden" name="_method" value="PATCH">'.
                            '<div class="col-12">'.
                                '<p class="text-center">'.
                                '<a href="'.$product->permalink.'" target="_blank"><img src="'.$imageSrc.'" style="width:180px;"></a>'.
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
                            '<button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>'.
                            '<button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>'.
                        '</form>'.
                    '</div>'.
                  '</div>'.
                '</div>';
                }


            }
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
            $img_fondo = base_path('../public_html/taller/cursos/fondo.png');
            $tipografia = base_path('../public_html/taller/assets/user/fonts/LeelaUIb.ttf');

        }else{
            $fotos_bicis = public_path() . '/productos_fotos';
            $img_fondo = public_path('cursos/fondo.png');
            $tipografia = public_path('assets/user/fonts/LeelaUIb.ttf');
        }

        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();

            $image = Image::make($file);

            $background = Image::make($img_fondo);

            // Redimensionar la imagen a un tamaño más grande
            $image->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $imageWithBackground = $background->insert($image, 'center');
            $text = wordwrap($request->get('name'), 25, "\n", true);
            // Obtener la imagen de fondo con el tamaño adecuado
            $backgroundResized = $background->resizeCanvas($imageWithBackground->getWidth(), $imageWithBackground->getHeight());
            $fontFile = base_path('../public_html/taller/assets/user/fonts/LeelaUIb.ttf');
            $fontSize = 40;
            $lineHeight = 1.5;
            $textBoundingBox = imagettfbbox($fontSize, 0, $fontFile, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $textHeight = ($textBoundingBox[1] - $textBoundingBox[7]) * $lineHeight;

            // Agregar texto en la parte inferior izquierda de la imagen de fondo
            $backgroundResized->text($text, 10, $backgroundResized->getHeight() - $textHeight + 73, function($font) use ($fontFile, $fontSize) {
                $font->file($fontFile);
                $font->size($fontSize);
                $font->color('#FFFFFF');
                $font->align('left');
                $font->valign('bottom');
            });

            // Guardar la imagen resultante
            $backgroundResized->save($path.'/'.$fileName);


            $ruta_completa = 'https://taller.maniabikes.com.mx/productos_fotos/' . $fileName;
        }

        $text_meta = "Encuentra este y más productos Shimano en nuestro sitio web. Somos distribuidores autorizados. Contamos con servicio de taller.
                    Contamos con una gran variedad de artículos para tu bicicleta en nuestra tienda en línea. Servicio de taller disponible en tienda.";
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
                ],
                7 => [
                    "key"=> "_yoast_wpseo_focuskw",
                    "value"=> $name,
                ],
                8 => [
                    "key"=> "_yoast_wpseo_metadesc",
                    "value"=> $text_meta,
                ],
                9 => [
                    "key" => "yoast_head",
                    "value" => <<<HTML
                        <title>$name</title>
                        <meta name="description" content="{$name}" />
                        <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
                        <link rel="canonical" href="www.maniabikes.com.mx" />
                        <meta property="og:locale" content="es_ES" />
                        <meta property="og:type" content="article" />
                        <meta property="og:title" content="{$name}" />
                        <meta property="og:description" content="{$name}" />
                        <meta property="og:url" content="www.maniabikes.com.mx" />
                        <meta property="og:site_name" content="ManiaBikes" />
                        <meta property="article:publisher" content="https://www.facebook.com/MANIABIKE/" />
                        <meta property="article:modified_time" content="" />
                        <meta property="og:image" content="{$ruta_completa}" />
                        <meta property="og:image:width" content="1080" />
                        <meta property="og:image:height" content="1080" />
                        <meta property="og:image:type" content="image/png" />
                        <meta name="twitter:card" content="summary_large_image" />
                        <meta name="twitter:label1" content="Precio" />
                        <meta name="twitter:data1" content="{$price}" />
                        <meta name="twitter:label2" content="Availability" />
                        <meta name="twitter:data2" content="Out of stock" />
                    HTML,
                ],
              ]
        ];

        $newProduct = Product::create($data);

        $user = new HistorialProductos;
            $user->id_producto = $newProduct->id;
            $user->accion = 'Alta de stock';
            $user->cantidad = $request->get('stock_quantity');
            $user->id_user =  auth()->id();
        $user->save();

         Alert::success('Producto creado', 'Se ha guardado con exito');
         return redirect()->back();

    }
}
