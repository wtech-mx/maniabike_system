<?php

namespace App\Http\Controllers;
use App\Models\Notas;
use App\Models\ProductoNota;
use Codexshaper\WooCommerce\Facades\Customer ;
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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

    public function imprimir($id){

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

    $nombreImpresora = "POS-58";
    // Crear una conexión con la impresora (debes configurar la ruta correcta según tu sistema operativo)
    $connector = new WindowsPrintConnector($nombreImpresora);
    $printer = new Printer($connector);

    // Configurar el estilo del recibo (opcional)
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(2, 2);
    $printer->text("¡Recibo de Maniabike!\n");

    // Imprimir el contenido del recibo
    $printer->setTextSize(1, 1);
    $printer->text("Fecha:                           $notas->fecha\n");
    $printer->text("Metodo de pago                   $notas->metodo_pago\n");
    $printer->text("Modalidad:                       $notas->tipo\n");
    $printer->text("Nombre    Cantidad    Precio\n");
    $printer->text("-----------------------------------------\n");

    // Iterar a través de los productos e imprimirlos en el recibo
    foreach ($notas_productos as $notas_producto) {
        $nombreProducto = $notas_producto->name;
        $cantidad = $notas_producto->cantidad;
        $precio = $notas_producto->precio;
        $subtotal = $notas_producto->subtotal;
        $printer->text("Producto:\n$nombreProducto\n");
        $printer->text("Cantidad:\n$cantidad\n");
        $printer->text("Precio:  \n$$precio\n");
        $printer->text("--------------------------\n");

    }

    $printer->text("-----------------------------------------\n");

    // Imprimir el total
    $printer->text("Total:                           $$notas->total\n\n\n\n");

    // Cortar el papel y cerrar la conexión
    $printer->cut();
    $printer->close();

    return redirect()->back();
    }
}
