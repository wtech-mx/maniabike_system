<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Taller;
use App\Models\Cliente;
use App\Models\TallerProductos;
use Illuminate\Http\Request;

class TallerController extends Controller
{
    public function index()
    {

        return view('servicios.index');
    }

    public function create()
    {
        $cliente = Cliente::get();

        return view('servicios.create',compact('cliente'));
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
        if($request->get('name') != NULL){
            $taller->id_cliente = $client->id;
        }else{
            $taller->id_cliente = $request->get('id_cliente');
        }
        $taller->marca = $request->get('marca');
        $taller->modelo = $request->get('modelo');
        $taller->rodada = $request->get('rodada');
        $taller->tipo = $request->get('tipo');
        $taller->color = $request->get('color');
        $taller->foto1 = $request->get('foto1');
        $taller->foto2 = $request->get('foto2');
        $taller->foto3 = $request->get('foto3');
        $taller->foto4 = $request->get('foto4');
        $taller->cadena = $request->get('cadena');
        $taller->sprock = $request->get('sprock');
        $taller->multiplicacion = $request->get('multiplicacion');
        $taller->llanta_d = $request->get('llanta_d');
        $taller->llanta_t = $request->get('llanta_t');
        $taller->frenos_d = $request->get('frenos_d');
        $taller->frenos_t = $request->get('frenos_t');
        $taller->observaciones = $request->get('observaciones');
        $taller->eje = $request->get('eje');
        $taller->camaras = $request->get('camaras');
        $taller->mandos = $request->get('mandos');
        $taller->save();

        // G U A R D A R  P R O D U C T O  T A L L E R
        $taller_producto = new TallerProductos;
        $taller_producto->id_taller = $taller->id;
        $taller_producto->producto = $request->get('mandos');
        $taller_producto->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('clients.index')
            ->with('success', 'Cliente Creado.');
    }
}
