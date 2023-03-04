<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use Session;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    public function index()
    {
        $cursos = Cursos::orderBy('id','DESC')->get();

        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $curso = new Cursos;
        $curso->nombre = $request->get('nombre');
        $curso->descripcion = $request->get('descripcion');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/curso';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto = $fileName;
        }
        $curso->fecha_inicial = $request->get('fecha_inicial');
        $curso->hora_inicial = $request->get('hora_inicial');
        $curso->fecha_final = $request->get('fecha_final');
        $curso->hora_final = $request->get('hora_final');
        $curso->categoria = $request->get('categoria');
        $curso->modalidad = $request->get('modalidad');
        $curso->objetivo = $request->get('objetivo');
        $curso->temario = $request->get('temario');
        $curso->sep = $request->get('sep');
        $curso->unam = $request->get('unam');
        $curso->stps = $request->get('stps');
        $curso->redconocer = $request->get('redconocer');
        $curso->imnas = $request->get('imnas');
        $curso->recurso = $request->get('recurso');
        $curso->informacion = $request->get('informacion');
        $curso->destacado = $request->get('destacado');
        $curso->estatus = $request->get('estatus');

        $curso->save();

        // G U A R D A R  T I C K E T
        $nombre_ticket = $request->get('nombre_ticket');
        $descripcion_ticket = $request->get('descripcion_ticket');
        $precio_ticket = $request->get('precio');
        $fecha_inicial_ticket = $request->get('fecha_inicial_ticket');
        $fecha_final_ticket = $request->get('fecha_final_ticket');

        for ($count = 0; $count < count($nombre_ticket); $count++) {
            $data = array(
                'id_curso' => $curso->id,
                'nombre' => $nombre_ticket[$count],
                'descripcion' => $descripcion_ticket[$count],
                'precio' => $precio_ticket[$count],
                'fecha_inicial' => $fecha_inicial_ticket[$count],
                'fecha_final' => $fecha_final_ticket[$count],
            );
            $insert_data[] = $data;
        }

        CursosTickets::insert($insert_data);

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('cursos.index')
            ->with('success', 'curso created successfully.');
    }
}
