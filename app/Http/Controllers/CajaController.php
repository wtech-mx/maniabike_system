<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;
use Session;
    use Codexshaper\WooCommerce\Facades\WooCommerce;
    use Codexshaper\WooCommerce\Facades\Customer;
use Illuminate\Support\Facades\Validator;
use Codexshaper\WooCommerce\Facades\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;
use App\Models\ProductoNota;
use App\Models\Cliente;
use Automattic\WooCommerce\Client;
use Carbon\Carbon;
use Order;



class CajaController extends Controller
{

    public function index()
    {

        $page = 1;
        $perPage = 100; // Cantidad máxima de clientes por página
        $allCustomers = [];

        do {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://www.maniabikes.com.mx/inicio/wp-json/wc/v3/customers', [
                'auth' => ['ck_669c65e13b042664bbf29cc9dd04f86b33b8f568', 'cs_4e770f2fa9f7bc9f5aca5d9bb5c3cda3478fea9a'],
                'query' => [
                    'page' => $page,
                    'per_page' => $perPage,
                ],
            ]);

            $customers = json_decode($response->getBody());
            $allCustomers = array_merge($allCustomers, $customers);

            $page++;
        } while (count($customers) === $perPage);

        $filteredCustomers = array_filter($allCustomers, function ($customer) {
            // Comprobar si el usuario tiene el role "mayorista" en el meta-data (key 28)
            foreach ($customer->meta_data as $meta) {
                if ($meta->key === 'role' && $meta->value === 'minorista') {
                    return true;
                }
            }
            return false;
        });

        $customerUsernames = array_map(function ($customer) {
            return [
                'id' => $customer->id,
                'email' => $customer->email,
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'phone' => $customer->billing->phone,

            ];
        }, $filteredCustomers);

        $filteredCustomers2 = array_filter($allCustomers, function ($customer) {
            // Comprobar si el usuario tiene el role "mayorista" en el meta-data (key 28)
            foreach ($customer->meta_data as $meta) {
                if ($meta->key === 'role' && $meta->value === 'mayorista') {
                    return true;
                }
            }
            return false;
        });


        $customerUsernames2 = array_map(function ($customer) {
            return [
                'id' => $customer->id,
                'email' => $customer->email,
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'phone' => $customer->billing->phone,

            ];
        }, $filteredCustomers2);

        $order = Order::get();
        return view('admin.caja.index2',compact('customerUsernames', 'customerUsernames2'));
    }

    public function obtenerNombreProducto(Request $request)
    {
        $codigo = $request->input('codigo');

        // Realizar la consulta a la base de datos para obtener el producto según el código
        $producto = Product::where('sku', $codigo)->first();

        $letrasNumeros = [
            'M' => 1,
            'A' => 2,
            'R' => 3,
            'Q' => 4,
            'U' => 5,
            'E' => 6,
            'S' => 7,
            'I' => 8,
            'T' => 9,
            'O' => 0
        ];

        $claveMayorista = null;

        foreach ($producto['meta_data'] as $item) {
            if ($item->key === 'clave_mayorista') {
                $claveMayorista = $item->value;
                break;
            }
        }

        if ($claveMayorista) {
            $precioMayorista = '';

            for ($i = 0; $i < strlen($claveMayorista); $i++) {
                $letra = strtoupper($claveMayorista[$i]);
                if (isset($letrasNumeros[$letra])) {
                    $valorNumerico = $letrasNumeros[$letra];
                    $precioMayorista .= $valorNumerico;
                }
            }
        }

        if ($producto) {
            $nombre = $producto['name'];
            $precio = $producto['price'];
            $id = $producto['id'];
            $clave = $claveMayorista;
            $precio_mayo = $precioMayorista;

            return response()->json(['nombre' => $nombre, 'precio' => $precio, 'precio_mayo' => $precio_mayo, 'id' => $id]);
        } else {
            return response()->json(['nombre' => 'Producto no encontrado']);
        }
    }

    public function caja_search(Request $request)
    {
        $fechaActual = date('Y-m-d');
        $clientes = Cliente::get();

        if ($request->ajax()) {
            $output = "";
            $productos = $request->productos;
            $products = [];
            $total = 0;

            $output .= '
            <div class="row">' .
                '<div class="col-12">' .
                '<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">' .
                    '<li class="nav-item" role="presentation">' .
                    '<button class="nav-link active" id="pills-minorista-tab" data-bs-toggle="pill" data-bs-target="#pills-minorista" type="button" role="tab" aria-controls="pills-minorista" aria-selected="true">Minorista</button>' .
                    '</li>' .
                    '<li class="nav-item" role="presentation">' .
                    '<button class="nav-link" id="pills-mayorista-tab" data-bs-toggle="pill" data-bs-target="#pills-mayorista" type="button" role="tab" aria-controls="pills-mayorista" aria-selected="false">Mayorista</button>' .
                    '</li>' .
                '</ul>' .
                '<div class="tab-content" id="pills-tabContent">' .
                    '<div class="tab-pane fade show active" id="pills-minorista" role="tabpanel" aria-labelledby="pills-minorista-tab">' .
                    '<form class="row" method="POST" action="'. route('caja.store') .'" enctype="multipart/form-data" role="form">' .
                    '<input type="hidden" name="_token" value="'. csrf_token() .'" />';

                    foreach ($productos as $producto) {
                        $products = Product::where('sku', $producto)->first();

                        if ($products) {
                            $products[] = $products;

                            $output .=
                                '<div class="col-6">' .
                                '<p class=""><strong class="">Nombre:  </strong> <br>' . $products['name'] . '<br><strong class="">' . $products['sku'] . '</strong></p>' .
                                '</div>' .
                                '<input class="form-control" type="hidden" name="id_product[]" id="id_product" value="' . $products['id'] . '">' .
                                '<div class="col-3">' .
                                '<p class=""><strong class="">Cantidad:  </strong> <br></p>' .
                                '<input class="form-control cantidad" type="number" name="cantidad[]" id="cantidad" value="1">' .
                                '</div>' .
                                '<div class="col-3 ">' .
                                '<p class=""><strong class="">Precio:  </strong> <br></p>' .
                                '<input class="form-control precio" type="number" name="price[]" id="price" value="' . $products['price'] . '">' .
                                '</div>';
                        }
                    }

                    $output .= '<div class="col-6">' .
                        '</div>' .
                        '<div class="col-3">' .
                        '<p class=""><strong class="">Tipo :</strong></span></p>' .
                        '<select class="form-select" name="tipo" id="tipo">' .
                        '<option selected>Ninguno</option>' .
                        '<option value="Porcentaje">Porcentaje</option>' .
                        '<option value="Fijo">Fijo</option>' .
                        '</select>' .
                        '</div>' .
                        '<div class="col-3">' .
                        '<p class=""><strong class="">Descuento: </strong></span></p>' .
                        '<input class="form-control" type="number" name="descuento" id="descuento" value="0">' .
                        '</div>' .
                        '<div class="col-12">' .
                        '<p class=""><strong class="">Método de pago : </strong></span></p>' .
                        '<select class="form-select" name="metodo_pago" id="metodo_pago">' .
                        '<option selected>Selecciona Método de Pago</option>' .
                        '<option value="Efectivo">Efectivo</option>' .
                        '<option value="Tarjeta">Tarjeta crédito/débito</option>' .
                        '<option value="Transferencia">Transferencia</option>' .
                        '</select>' .
                        '</div>' .
                        '<div class="col-12">' .
                        '<p class=""><strong class="">Comentario : </strong></span></p>' .
                        '<textarea class="form-control" name="comentario" id="comentario" rows="2"></textarea>' .
                        '</div>' .
                        '<div class="col-12">' .
                        '<p class=""><strong class="">Comprobante : </strong></span></p>' .
                        '<input class="form-control" type="file" name="comprobante" id="comprobante" value="">' .
                        '</div>' .
                        '<div class="col-6 mt-2">' .
                        '<p class=""><strong class=""></strong><span class="total"></span></p>' .
                        '<button id="btnCalcular" class="btn btn-primary" type="button">Calcular</button>' .
                        '</div>' .
                        '<div class="col-3 mt-2">' .
                        '<p class=""><strong class="">Subtotal : </strong></span></p>' .
                        '<input class="form-control" type="number" name="subtotal" id="subtotal" value="">' .
                        '</div>' .
                        '<div class="col-3 mt-2">' .
                        '<p class=""><strong class="">Total : </strong></span></p>' .
                        '<input class="form-control" type="number" name="total" id="total" value="">' .
                        '</div>' .
                        '<div class="col-6 mt-2">' .
                        '</div>' .
                        '<div class="col-6 mt-2">' .
                        '<button type="submit" class="btn btn-primary" style="width: 100%">Guardar</button>'.
                        '</div>' .
                        '</div>' .
                        '</form>'.
                    '</div>' .
                    '<div class="tab-pane fade" id="pills-mayorista" role="tabpanel" aria-labelledby="pills-mayorista-tab">' .
                    '<form class="row" method="POST" action="'. route('caja.store') .'" enctype="multipart/form-data" role="form">' .
                    '<input type="hidden" name="_token" value="'. csrf_token() .'" />';

                    foreach ($productos as $producto) {
                        $products = Product::where('sku', $producto)->first();

                        if($products['meta_data'][5]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][8]->value;

                        }elseif($products['meta_data'][6]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][9]->value;

                        }elseif($products['meta_data'][7]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][10]->value;

                        }elseif($products['meta_data'][16]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][22]->value;

                        }elseif($products['meta_data'][17]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][23]->value;

                        }elseif($products['meta_data'][18]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][24]->value;

                        }elseif($products['meta_data'][19]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][25]->value;

                        }elseif($products['meta_data'][20]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][26]->value;

                        }elseif($products['meta_data'][21]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][27]->value;

                        }elseif($products['meta_data'][22]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][28]->value;

                        }elseif($products['meta_data'][23]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][29]->value;

                        }elseif($products['meta_data'][24]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][30]->value;

                        }elseif($products['meta_data'][25]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][31]->value;

                        }elseif($products['meta_data'][26]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][32]->value;

                        }elseif($products['meta_data'][27]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][33]->value;

                        }elseif($products['meta_data'][28]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][34]->value;

                        }elseif($products['meta_data'][29]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][35]->value;

                        }elseif($products['meta_data'][30]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][36]->value;

                        }elseif($products['meta_data'][31]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][37]->value;

                        }elseif($products['meta_data'][32]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][38]->value;

                        }elseif($products['meta_data'][33]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][39]->value;

                        }elseif($products['meta_data'][34]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][40]->value;

                        }elseif($products['meta_data'][35]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][41]->value;
                        }elseif($products['meta_data'][35]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][41]->value;
                        }elseif($products['meta_data'][36]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][42]->value;
                        }elseif($products['meta_data'][37]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][43]->value;
                        }elseif($products['meta_data'][114]->key == "id_proveedor"){

                            $clave_mayorista = $products['meta_data'][15]->value;
                        }elseif($products['meta_data'][118]->key == "id_proveedor"){
                            $clave_mayorista = $products['meta_data'][120]->value;

                        }

                            if(isset($clave_mayorista)){
                            // tu código aquí si $clave_mayorista está definido
                            } else {
                            $clave_mayorista = "";
                            }

                            $letraNumeroMapa = array(
                            'M' => 1,
                            'A' => 2,
                            'R' => 3,
                            'Q' => 4,
                            'U' => 5,
                            'E' => 6,
                            'S' => 7,
                            'I' => 8,
                            'T' => 9,
                            'O' => 0
                        );

                        $numero = '';
                        $letras = str_split($clave_mayorista);


                        foreach ($letras as $letra) {
                            if (isset($letraNumeroMapa[$letra])) {
                                $numero .= $letraNumeroMapa[$letra];
                            }
                        }

                        if ($products) {
                            $products[] = $products;
                            $subtotal = 0;

                            $output .=
                                '<div class="col-6">' .
                                '<p class=""><strong class="">Nombre:  </strong> <br>' . $products['name'] . '<br><strong class="">' . $products['sku'] . '</strong></p>' .
                                '</div>' .
                                '<input class="form-control" type="hidden" name="id_product[]" id="id_product" value="' . $products['id'] . '">' .
                                '<div class="col-3">' .
                                '<p class=""><strong class="">Cantidad:  </strong> <br></p>' .
                                '<input class="form-control cantidad2" type="number" name="cantidad2" id="cantidad2" value="1">' .
                                '</div>' .
                                '<div class="col-3 ">' .
                                '<p class=""><strong class="">Mayoreo:  </strong> <br></p>' .
                                '<input class="form-control price2" type="text" name="price2" id="price2" value="'.$numero.'">' .
                                '</div>';
                            $total += $subtotal;
                        }
                    }
                    $output .= '<div class="col-6">' .
                    '</div>' .
                    '<div class="col-3">' .
                    '<p class=""><strong class="">Tipo :</strong></span></p>' .
                    '<select class="form-select" name="tipo" id="tipo">' .
                    '<option selected>Ninguno</option>' .
                    '<option value="Porcentaje">Porcentaje</option>' .
                    '<option value="Fijo">Fijo</option>' .
                    '</select>' .
                    '</div>' .
                    '<div class="col-3">' .
                    '<p class=""><strong class="">Descuento: </strong></span></p>' .
                    '<input class="form-control" type="number" name="descuento" id="descuento" value="0">' .
                    '</div>' .
                    '<div class="col-12">' .
                    '<p class=""><strong class="">Método de pago : </strong></span></p>' .
                    '<select class="form-select" name="metodo_pago" id="metodo_pago">' .
                    '<option selected>Selecciona Método de Pago</option>' .
                    '<option value="Efectivo">Efectivo</option>' .
                    '<option value="Tarjeta">Tarjeta crédito/débito</option>' .
                    '<option value="Transferencia">Transferencia</option>' .
                    '</select>' .
                    '</div>' .
                    '<div class="col-12">' .
                    '<p class=""><strong class="">Comentario : </strong></span></p>' .
                    '<textarea class="form-control" name="comentario" id="comentario" rows="2"></textarea>' .
                    '</div>' .
                    '<div class="col-12">' .
                    '<p class=""><strong class="">Comprobante : </strong></span></p>' .
                    '<input class="form-control" type="file" name="comprobante" id="comprobante" value="">' .
                    '</div>' .
                    '<div class="col-6 mt-2">' .
                    '<p class=""><strong class=""></strong><span class="total"></span></p>' .
                    '<button id="" class="btn btn-primary" type="button">Calcular2</button>' .
                    '</div>' .
                    '<div class="col-3 mt-2">' .
                    '<p class=""><strong class="">Subtotal : </strong></span></p>' .
                    '<input class="form-control" type="number" name="subtotal" id="subtotal" value="">' .
                    '</div>' .
                    '<div class="col-3 mt-2">' .
                    '<p class=""><strong class="">Total : </strong></span></p>' .
                    '<input class="form-control" type="number" name="total" id="total" value="">' .
                    '</div>' .
                    '<div class="col-6 mt-2">' .
                    '</div>' .
                    '<div class="col-6 mt-2">' .
                    '<button type="submit" class="btn btn-primary" style="width: 100%">Guardar</button>'.
                    '</div>' .
                    '</div>' .
                    '</form>';


                    '</form>' .
                    '</div>' .
                '</div>' .
                '</div>' .
            '</div>';



            return response()->json($output);
        }
    }

    public function store(Request $request)
    {

        Validator::extend('telefono', function ($attribute, $value, $parameters, $validator) {
            return !\App\Models\Cliente::where('telefono', $value)->exists();
        });

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'metodo_pago' => 'required',
        ]);

        $dominio = $request->getHost();
        if($dominio == 'taller.maniabikes.com.mx'){
            $fotos_bicis = base_path('../public_html/taller/comprobantes');
        }else{
            $fotos_bicis = public_path() . '/comprobantes';
        }


        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('id')) {
                $errorMessage = 'Faltan productos';
                Alert::warning('Error', $errorMessage);
            }
            if ($errors->has('metodo_pago')) {
                $errorMessage = 'Falta Metodo de pago';
                Alert::warning('Error', $errorMessage);
            }
            if ($errors->has('telefono')) {
                $errorMessage = 'Telefeono existente.';
                Alert::warning('Error', $errorMessage);
            }
            if ($errors->has('email')) {
                $errorMessage = 'Email existente.';
                Alert::warning('Error', $errorMessage);
            }
            return redirect()->route('index.caja');
        }


        $fechaActual = Carbon::now();
        // G U A R D A R  N O T A  P R I N C I P A L
        $caja = new Caja;
        if($request->get('nombre') != NULL){
            $client = new Cliente;
            $client->nombre = $request->get('nombre') . ' ' . $request->get('apellido');
            $client->telefono = $request->get('telefono');
            $client->email = $request->get('email');
            $client->id_user = auth()->id();
            $client->save();

            $role = 'minorista';

            $data = [
                'first_name' => $request->get('nombre'),
                'last_name' => $request->get('apellido'),
                'email' => $request->get('email'),
                'billing' => [
                    'first_name' => $request->get('nombre'),
                    'last_name' => $request->get('apellido'),
                    'email' => $request->get('email'),
                    'phone' => $request->get('telefono')
                ],
                'meta_data' => [
                    3 => [
                        "key"=> "role",
                        "value"=> $role,
                      ],
                ],
            ];

            $cliente_woo = Customer::create($data);
            $caja->id_client = $cliente_woo['id'];
        }else{
            $caja->id_client = $request->get('id_client');
        }

        $caja->fecha = $fechaActual;
        $caja->metodo_pago = $request->get('metodo_pago');
        $caja->comprobante = $request->get('comprobante');
        $caja->total = $request->get('total');
        $caja->tipo = 'Minorista';
        $caja->saldo_favor = $request->get('saldo_favor');
        $restante = $request->get('total') - $request->get('saldo_favor');
        $caja->restante = $restante;
        $caja->id_user = auth()->id();

        if ($request->hasFile("comprobante")) {
            $file = $request->file('comprobante');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $caja->comprobante = $fileName;
        }
        $caja->save();

        // Guardar Productos en ProductoNota
        $productos = $request->get('id');
        $cantidad = $request->get('cantidad');
        $subtotal = $request->get('subtotal');
        $precio = $request->get('precio');
        $name = $request->get('name');

        for ($count = 0; $count < count($productos); $count++) {
            $data = array(
                'id_product_woo' => $productos[$count],
                'id_nota' => $caja->id,
                'cantidad' => $cantidad[$count],
                'subtotal' => $subtotal[$count],
                'precio' => $precio[$count],
                'name' => $name[$count],
            );
            $insert_data2[] = $data;
        }

        ProductoNota::insert($insert_data2);

        $orderItems = [];

        for ($count = 0; $count < count($productos); $count++) {
            $orderItems[] = [
                'product_id' => $productos[$count], // ID del producto en WooCommerce
                'quantity' => $cantidad[$count],
                'price' => $precio[$count],
                'subtotal' => $precio[$count],
                'total' => $subtotal[$count],
            ];
        }
        $cliente = Customer::find($caja->id_client);

        if($request->get('metodo_pago') == 'Deudor'){

        // Crear el array de datos completo para enviar a la API
        $data = [
            'payment_method' => $caja->metodo_pago,
            'payment_method_title' => $caja->metodo_pago,
            'set_paid' => true,
            'line_items' => $orderItems,
            'status' => 'on-hold',
            'total' => $caja->total,
            'customer_id' => $caja->id_client,
            'billing' => [
                'first_name' => $cliente['first_name'],
                'last_name' => $cliente['last_name'],
                'address_1' => 'Circuito interior 888',
                'address_2' => '',
                'city' => 'CDMX',
                'state' => 'CDMX',
                'postcode' => '94103',
                'country' => 'Mexico',
                'email' => $cliente['email'],
                'phone' => $cliente['billing']->phone
                ],
            ];

        }else{
        // Crear el array de datos completo para enviar a la API
        $data = [
            'payment_method' => $caja->metodo_pago,
            'payment_method_title' => $caja->metodo_pago,
            'set_paid' => true,
            'line_items' => $orderItems,
            'status' => 'completed',
            'total' => $caja->total,
            'customer_id' => $caja->id_client,
            'billing' => [
                'first_name' => $cliente['first_name'],
                'last_name' => $cliente['last_name'],
                'address_1' => 'Circuito interior 888',
                'address_2' => '',
                'city' => 'CDMX',
                'state' => 'CDMX',
                'postcode' => '94103',
                'country' => 'Mexico',
                'email' => $cliente['email'],
                'phone' => $cliente['billing']->phone
                ],
            ];
        }

        $order = Order::create($data);


        // Verificar la condición para mostrar la alerta condicional
        if ($order == true) {

            $notas_edit = Caja::find($caja->id)->first();
            $notas_edit->id_product = $order['id'];
            $notas_edit->update();

            Alert::question('Registro exitoso', '¿Qué deseas hacer?')
            ->showCancelButton('Seguir escaneando', '#3085d6')
            ->showConfirmButton('Generar recibo', '#d33')
            ->persistent(false)
            ->footer('<a href="'.route('notas.edit', $caja->id).'">Ver recibo</a>')
            ->position('bottom-end')
            ->toToast();

        }

        return redirect()->route('index.caja')
            ->with('success', 'Caja Creado.');

    }

    public function store2(Request $request)
    {

        Validator::extend('telefono', function ($attribute, $value, $parameters, $validator) {
            return !\App\Models\Cliente::where('telefono', $value)->exists();
        });

        $validator = Validator::make($request->all(), [
            'id2' => 'required',
            'metodo_pago2' => 'required',
        ]);

        $dominio = $request->getHost();
        if($dominio == 'taller.maniabikes.com.mx'){
            $fotos_bicis = base_path('../public_html/taller/comprobantes');
        }else{
            $fotos_bicis = public_path() . '/comprobantes';
        }

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('id2')) {
                $errorMessage = 'Faltan productos';
                Alert::warning('Error', $errorMessage);
            }
            if ($errors->has('metodo_pago2')) {
                $errorMessage = 'Falta Metodo de pago';
                Alert::warning('Error', $errorMessage);
            }
            if ($errors->has('telefono2')) {
                $errorMessage = 'Telefeono existente.';
                Alert::warning('Error', $errorMessage);
            }
            if ($errors->has('email2')) {
                $errorMessage = 'Email existente.';
                Alert::warning('Error', $errorMessage);
            }
            return redirect()->route('index.caja');
        }

        $fechaActual = Carbon::now();

        // G U A R D A R  N O T A  P R I N C I P A L
        $caja = new Caja;
        if($request->get('nombre2') != NULL){
            $client = new Cliente;
            $client->nombre = $request->get('nombre2');
            $client->telefono = $request->get('telefono2');
            $client->email = $request->get('email2');
            $client->id_user = auth()->id();
            $client->save();

            $role = 'mayorista';

            $data = [
                'first_name' => $request->get('nombre2'),
                'last_name' => $request->get('apellido2'),
                'email' => $request->get('email2'),
                'billing' => [
                    'first_name' => $request->get('nombre2'),
                    'last_name' => $request->get('apellido2'),
                    'email' => $request->get('email2'),
                    'phone' => $request->get('telefono2')
                ],
                'meta_data' => [
                    3 => [
                        "key"=> "role",
                        "value"=> $role,
                      ],
                ],
            ];

            $cliente_woo = Customer::create($data);
            $caja->id_client = $cliente_woo['id'];
        }else{
            $caja->id_client = $request->get('id_client2');
        }

        $caja->fecha = $fechaActual;
        $caja->metodo_pago = $request->get('metodo_pago2');
        $caja->comprobante = $request->get('comprobante2');
        $caja->total = $request->get('total2');
        $caja->tipo = 'Mayorista';
        $caja->saldo_favor = $request->get('saldo_favor2');
        $restante = $request->get('total2') - $request->get('saldo_favor2');
        $caja->restante = $restante;
        $caja->id_user = auth()->id();

        if ($request->hasFile("comprobante2")) {
            $file = $request->file('comprobante2');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $caja->comprobante = $fileName;
        }
        $caja->save();

        // Guardar Productos en ProductoNota
        $productos = $request->get('id2');
        $cantidad = $request->get('cantidad2');
        $subtotal = $request->get('subtotal2');
        $precio = $request->get('precio2');
        $name = $request->get('name2');

        for ($count = 0; $count < count($productos); $count++) {
            $data = array(
                'id_product_woo' => $productos[$count],
                'id_nota' => $caja->id,
                'cantidad' => $cantidad[$count],
                'subtotal' => $subtotal[$count],
                'precio' => $precio[$count],
                'name' => $name[$count],
            );
            $insert_data2[] = $data;
        }
        ProductoNota::insert($insert_data2);

        $orderItems = [];

        for ($count = 0; $count < count($productos); $count++) {
            $orderItems[] = [
                'product_id' => $productos[$count], // ID del producto en WooCommerce
                'quantity' => $cantidad[$count],
                'price' => $precio[$count],
                'subtotal' => $precio[$count],
                'total' => $subtotal[$count],
            ];
        }

        $cliente = Customer::find($caja->id_client);

        if($request->get('metodo_pago') == 'Deudor'){

            // Crear el array de datos completo para enviar a la API
            $data = [
                'payment_method' => $caja->metodo_pago,
                'payment_method_title' => $caja->metodo_pago,
                'set_paid' => true,
                'line_items' => $orderItems,
                'status' => 'on-hold',
                'total' => $caja->total,
                'customer_id' => $caja->id_client,
                'billing' => [
                    'first_name' => $cliente['first_name'],
                    'last_name' => $cliente['last_name'],
                    'address_1' => 'Circuito interior 888',
                    'address_2' => '',
                    'city' => 'CDMX',
                    'state' => 'CDMX',
                    'postcode' => '94103',
                    'country' => 'Mexico',
                    'email' => $cliente['email'],
                    'phone' => $cliente['billing']->phone
                    ],
                ];

            }else{
            // Crear el array de datos completo para enviar a la API
            $data = [
                'payment_method' => $caja->metodo_pago,
                'payment_method_title' => $caja->metodo_pago,
                'set_paid' => true,
                'line_items' => $orderItems,
                'status' => 'completed',
                'total' => $caja->total,
                'customer_id' => $caja->id_client,
                'billing' => [
                    'first_name' => $cliente['first_name'],
                    'last_name' => $cliente['last_name'],
                    'address_1' => 'Circuito interior 888',
                    'address_2' => '',
                    'city' => 'CDMX',
                    'state' => 'CDMX',
                    'postcode' => '94103',
                    'country' => 'Mexico',
                    'email' => $cliente['email'],
                    'phone' => $cliente['billing']->phone
                    ],
                ];
            }

        $order = Order::create($data);

        // Verificar la condición para mostrar la alerta condicional
        if ($order == true) {

            $notas_edit = Caja::find($caja->id)->first();
            $notas_edit->id_product = $order['id'];
            $notas_edit->update();

            Alert::question('Registro exitoso', '¿Qué deseas hacer?')
            ->showCancelButton('Seguir escaneando', '#3085d6')
            ->showConfirmButton('Generar recibo', '#d33')
            ->persistent(false)
            ->footer('<a href="'.route('notas.edit', $caja->id).'">Ver recibo</a>')
            ->position('bottom-end')
            ->toToast();
        }

        return redirect()->route('index.caja')
            ->with('success', 'Caja Creado.');
    }

    public function estatus(Request $request,$id){

        $caja = Caja::find($id);

        if($request->get('estatus') == 'pagado'){

            // Actualizar el estado de la orden en WooCommerce
            $data     = [
                'status' => 'completed',
            ];

            // $numb = (int)$caja->id_product;
            // $order = Order::update($numb, $data);

            $caja->metodo_pago = $request->get('estatus');


        }elseif($request->get('estatus') == 'cancelado'){
            // Actualizar el estado de la orden en WooCommerce
            $data     = [
                'status' => 'cancelled',
            ];

            $numb = (int)$caja->id_product;
            $order = Order::update($numb, $data);

            $caja->metodo_pago = $request->get('estatus');


        }elseif($request->get('estatus') == 'deudor'){
            // Actualizar el estado de la orden en WooCommerce
            $data     = [
                'status' => 'on-hold',
            ];

            // $numb = (int)$caja->id_product;
            // $order = Order::update($numb, $data);
            $caja->metodo_pago = $request->get('estatus');

        }

        $caja->update();

        Alert::info('Estado Actualizado', 'Se ha cambiado el estatus con exito');
        return redirect()->back()->with('success', 'your message,here');
    }

}

