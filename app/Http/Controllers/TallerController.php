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

class TallerController extends Controller
{
    public function index()
    {
        $servicios = Taller::get();

        return view('admin.servicios.index', compact('servicios'));
    }

    public function create()
    {
        $cliente = Cliente::get();
        $productos = WooCommerce::all('products');

        return view('admin.servicios.create',compact('cliente','productos'));
    }

    public function store(Request $request)
    {

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
            $path = public_path() . '/servicio';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto1 = $fileName;
        }

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = public_path() . '/servicio';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto2 = $fileName;
        }

        if ($request->hasFile("foto3")) {
            $file = $request->file('foto3');
            $path = public_path() . '/servicio';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto3 = $fileName;
        }

        if ($request->hasFile("foto4")) {
            $file = $request->file('foto4');
            $path = public_path() . '/servicio';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto4 = $fileName;
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

        // G U A R D A R  P R O D U C T O  T A L L E R
        $taller_producto = new TallerProductos;
        $taller_producto->id_taller = $taller->id;
        $taller_producto->producto = $request->get('producto');
        $taller_producto->save();

        Alert::success('Servicio Guardado', 'Se ha guardado con exito');
        return redirect()->route('taller.index')
            ->with('success', 'Servicio Creado.');
    }


    public function edit_status(Request $request, $id){
        $taller = Taller::find($id);
        $taller->estatus = $request->get('estatus');
        $taller->update();
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
            $path = public_path() . '/servicio';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto1 = $fileName;
        }

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = public_path() . '/servicio';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto2 = $fileName;
        }

        if ($request->hasFile("foto3")) {
            $file = $request->file('foto3');
            $path = public_path() . '/servicio';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $taller->foto3 = $fileName;
        }

        if ($request->hasFile("foto4")) {
            $file = $request->file('foto4');
            $path = public_path() . '/servicio';
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
}
