<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Taller;
use App\Models\Cliente;
use App\Models\TallerProductos;
use Session;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use RealRashid\SweetAlert\Facades\Alert;
use Codexshaper\WooCommerce\Facades\Product;
use Order;
use Barryvdh\DomPDF\Facade\Pdf;


class TallerController extends Controller
{
    public function index()
    {
        $servicios = Taller::orderBy('id','DESC')->get();
        $taller_productos = TallerProductos::get();

        return view('admin.servicios.index', compact('servicios','taller_productos'));
    }

    public function create()
    {
        $cliente = Cliente::get();
        $productos = WooCommerce::all('products');

        return view('admin.servicios.create',compact('cliente','productos'));
    }

    public function store_product(Request $request){
        if($request->get('sku') != NULL){
            $taller_product = new TallerProductos;
            $servicios = Taller::find($request->get('id'));

            $products = Product::where('sku', '=', $request->get('sku'))->first();

            $taller_product->producto = $products['name'];
            $taller_product->price = $products['price'];
            $taller_product->id_taller = $request->get('id');
            $taller_product->sku = $products['sku'];
            $taller_product->permalink = $products['permalink'];
            $taller_product->id_product_woo = $products['id'];
            $taller_product->save();
         }
         Alert::success('Producto agregado', 'Se ha guardado con exito');

         return redirect()->back();
        }

    public function imprimir(Request $request, $id){

        $taller = Taller::find($id);
        $cliente = Cliente::where('id', '=', $taller->id_cliente)->first();;

        $pdf = PDF::loadView('admin.servicios.pdf_servicio',compact('taller','cliente'));
        // Para cambiar la medida se deben pasar milimetros a putnos
        $pdf->setPaper([0, 0,141.732,70.8661], 'portrair');
        return $pdf->download('etiqueta'.$taller->folio.'.pdf');
    }


    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'taller.maniabikes.com.mx'){
            $fotos_bicis = base_path('../public_html/taller.maniabikes.com.mx/fotos_bicis');
        }else{
            $fotos_bicis = public_path() . '/fotos_bicis';
        }

        // N U E V O  U S U A R I O
        if($request->get('nombre') != NULL){
           $client = new Cliente;
           $client->nombre = $request->get('nombre');
           $client->telefono = $request->get('telefono');
           $client->email = $request->get('email');
           $client->save();
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        $taller = new Taller;
        if($request->get('nombre') != NULL){
            $taller->id_cliente = $client->id;
        }else{
            $taller->id_cliente = $request->get('id_cliente');
        }
        $taller->marca = $request->get('marca');
        $taller->modelo = $request->get('modelo');
        $taller->fecha = $request->get('fecha');
        $taller->rodada = $request->get('rodada');
        $taller->tipo = $request->get('tipo');
        $taller->color = $request->get('color');
        $taller->color_2 = $request->get('color_2');
        if ($request->hasFile("foto1")) {
            $file = $request->file('foto1');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto1 = $fileName;
        }

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto2 = $fileName;
        }

        if ($request->hasFile("foto3")) {
            $file = $request->file('foto3');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto3 = $fileName;
        }

        if ($request->hasFile("foto4")) {
            $file = $request->file('foto4');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto4 = $fileName;
        }
        $taller->cadena = $request->get('cadena');
        $taller->eje = $request->get('eje');
        $taller->llanta_d = $request->get('llanta_d');
        $taller->llanta_t = $request->get('llanta_t');
        $taller->frenos_d = $request->get('frenos_d');
        $taller->frenos_t = $request->get('frenos_t');
        $taller->camara_t = $request->get('camara_t');
        $taller->camara_d = $request->get('camara_d');
        $taller->folio = $request->get('folio');
        $taller->observaciones = $request->get('observaciones');
        $taller->mandos = $request->get('mandos');
        $taller->servicio = $request->get('servicio');
        $taller->total = $request->get('total');
        $taller->subtotal = $request->get('subtotal');
        $taller->estatus = 0;
        $taller->save();

        Alert::success('Servicio Guardado', 'Se ha guardado con exito');
        return redirect()->route('taller.index')
            ->with('success', 'Servicio Creado.');
    }


    public function edit_status(Request $request, $id){
        $taller = Taller::find($id);
        $taller->estatus = $request->get('estatus');
        $taller->update();

        if($request->get('estatus') == 3){
            if(!empty($id)){

                $products = TallerProductos::where('id_taller', '=', $id)->get();

                $line_items = [];
                // Recorrer los productos y agregarlos al array line_items
                foreach ($products as $product) {
                    $line_items[] = [
                        'product_id' => $product->id_product_woo,
                        'quantity' => 1
                    ];
                }
                // Crear el array de datos completo para enviar a la API
                $data = [
                    'payment_method' => 'bacs',
                    'payment_method_title' => 'Direct Bank Transfer',
                    'set_paid' => true,
                    'line_items' => $line_items,
                    'billing' => [
                        'first_name' => 'Pablo',
                        'last_name' => 'Sandoval Barroso',
                        'address_1' => 'Circuito interior 888',
                        'address_2' => '',
                        'city' => 'CDMX',
                        'state' => 'CDMX',
                        'postcode' => '94103',
                        'country' => 'Mexico',
                        'email' => 'bicimaniamixcoac@gmail.com',
                        'phone' => '5519637033'
                    ],
                ];

                $order = Order::create($data);
                Alert::info('Estado Actualizado', 'Se ha cambiado el estatus con exito y se ha creado la orden en woocomoerce');
                return redirect()->back()->with('success', 'your message,here');
            }
        }

        Alert::info('Estado Actualizado', 'Se ha cambiado el estatus con exito');
        return redirect()->back()->with('success', 'your message,here');
    }

    public function edit($id)
    {
        $cliente = Cliente::get();
        $servicio = Taller::find($id);
        $servicio_product = TallerProductos::where('id_taller', '=', $id)->get();

        return view('admin.servicios.edit',compact('cliente', 'servicio', 'servicio_product'));
    }

    public function show($id){
        $cliente = Cliente::get();
        $servicio = Taller::find($id);
        $servicio_product = TallerProductos::where('id_taller', '=', $id)->get();

        return view('admin.servicios.show',compact('cliente', 'servicio', 'servicio_product'));
    }

    public function update(Request $request, $id)
    {
        $dominio = $request->getHost();
        if($dominio == 'taller.maniabikes.com.mx'){
            $fotos_bicis = base_path('../public_html/taller.maniabikes.com.mx/fotos_bicis');
        }else{
            $fotos_bicis = public_path() . '/fotos_bicis';
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        $taller = Taller::find($id);
        $taller->id_cliente = $request->get('id_cliente');
        $taller->marca = $request->get('marca');
        $taller->modelo = $request->get('modelo');
        $taller->fecha = $request->get('fecha');
        $taller->rodada = $request->get('rodada');
        $taller->tipo = $request->get('tipo');
        $taller->color = $request->get('color');
        $taller->color_2 = $request->get('color_2');
        if ($request->hasFile("foto1")) {
            $file = $request->file('foto1');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto1 = $fileName;
        }

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto2 = $fileName;
        }

        if ($request->hasFile("foto3")) {
            $file = $request->file('foto3');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto3 = $fileName;
        }

        if ($request->hasFile("foto4")) {
            $file = $request->file('foto4');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto4 = $fileName;
        }
        $taller->cadena = $request->get('cadena');
        $taller->eje = $request->get('eje');
        $taller->llanta_d = $request->get('llanta_d');
        $taller->llanta_t = $request->get('llanta_t');
        $taller->frenos_d = $request->get('frenos_d');
        $taller->frenos_t = $request->get('frenos_t');
        $taller->camara_t = $request->get('camara_t');
        $taller->camara_d = $request->get('camara_d');
        $taller->folio = $request->get('folio');
        $taller->observaciones = $request->get('observaciones');
        $taller->mandos = $request->get('mandos');
        $taller->servicio = $request->get('servicio');
        $taller->total = $request->get('total');
        $taller->subtotal = $request->get('subtotal');
        $taller->update();

        // G U A R D A R  P R O D U C T O  T A L L E R
        $taller_producto = new TallerProductos;
        $taller_producto->id_taller = $taller->id;
        $taller_producto->producto = $request->get('producto');
        $taller_producto->save();

        Alert::success('Success Title', 'Se ha actualziado con exito');
        return redirect()->route('taller.index')
            ->with('success', 'Servicio Creado.');
    }

    public function update_precio_product(Request $request, $id){

        $servicio_product = TallerProductos::find($id);
        $servicio_product->price = $request->get('price');
        $servicio_product->update();
        Alert::success('Cambio de precio', 'Se ha cambiado el precio con exito');
        return redirect()->back();
    }

    public function update_precio_servicio(Request $request, $id){
        $servicio_precio = Taller::find($id);
        $servicio_precio->precio_servicio = $request->get('precio_servicio');
        $servicio_precio->update();
        Alert::success('Cambio de precio', 'Se ha cambiado el precio con exito');
        return redirect()->back();
    }

    public function destroy_products($id)
    {
        $product = TallerProductos::find($id);
        $product->delete();
        Alert::success('Producto eliminado', 'Se ha eliminado con exito');
        return redirect()->back();
    }

}
