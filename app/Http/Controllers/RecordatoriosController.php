<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recordatorios;
use RealRashid\SweetAlert\Facades\Alert;


class RecordatoriosController extends Controller
{
    public function index(){

        $recordatorios = Recordatorios::get();

        return view('admin.recordatorios.index', compact('recordatorios'));
    }

    public function create(request $request){

        $recordatorio = New Recordatorios;
        $recordatorio->cliente = $request->get('cliente');
        $recordatorio->fecha = $request->get('fecha');
        $recordatorio->descripcion = $request->get('descripcion');
        $recordatorio->estatus  = $request->get('estatus');
        $recordatorio->save();

        Alert::info('Estado Actualizado', 'Se ha cambiado el estatus con exito');
        return redirect()->back()->with('success', 'your message,here');    }

    public function edit(Request $request,$id){

        $recordatorio = Recordatorios::find($id);
        $recordatorio->cliente = $request->get('cliente');
        $recordatorio->fecha = $request->get('fecha');
        $recordatorio->descripcion = $request->get('descripcion');
        $recordatorio->estatus  = $request->get('estatus');
        $recordatorio->update();

        Alert::info('Estado Actualizado', 'Se ha cambiado el estatus con exito');
        return redirect()->back()->with('success', 'your message,here');    }

}
