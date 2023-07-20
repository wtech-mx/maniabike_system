<?php

namespace App\Http\Controllers;
use App\Models\Notas;
use App\Models\ProductoNota;
use Codexshaper\WooCommerce\Facades\Customer ;

use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function index()
    {
        $notas = Notas::orderBy('id','DESC')->get();

        return view('admin.caja.ordenes', compact('notas'));
    }


    public function edit($id){

        $notas = Notas::find($id);
        $notas_productos = ProductoNota::where('id_nota','=',$id)->get();

        $page = 1;
        $perPage = 1; // Número de productos por página que quieres obtener
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://www.maniabikes.com.mx/inicio/wp-json/wc/v3/customers', [
            'auth' => ['ck_669c65e13b042664bbf29cc9dd04f86b33b8f568', 'cs_4e770f2fa9f7bc9f5aca5d9bb5c3cda3478fea9a'],
            'query' => [
                'search' => $notas->id_client,
                'page' => $page,
                'per_page' => $perPage,
            ],
        ]);
        $total = $response->getHeaderLine(config('woocommerce.header_total'));

        $customers = json_decode($response->getBody());
        $customer = reset($customers);

        //dd($customer->email);
        return view('admin.recibo.recibo',compact('notas','notas_productos','customer'));
    }
}
