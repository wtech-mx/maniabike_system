<?php

namespace App\Http\Controllers;

use App\Models\TallerProductos;
use App\Models\Taller;
use App\Models\Cliente;

use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index(){

        return view('admin.scanner.index');
    }


    public function search(Request $request){

        if($request->ajax()){
            $output="";

            $products=Taller::where('folio','LIKE','%'.$request->search."%")->get();

            if($products){

                foreach ($products as $key => $product) {
                $output.='<tr>'.
                '<td>'.$product->id.'</td>'.
                '<td>'.$product->folio.'</td>'.
                '</tr>';
                }

                return Response($output);
            }
        }
    }

    public function store(request $request){

        dd($request);

        return view('admin.scanner.index');
    }
}
