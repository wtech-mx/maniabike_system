<?php

namespace App\Http\Controllers;

use App\Models\TallerProductos;
use App\Models\Taller;
use App\Models\Cliente;
use App\Models\ProductoNota;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class ScannerController extends Controller
{
    public function index(){

        return view('admin.scanner.index');
    }

    public function index_products(){
        return view('admin.scanner.index_product');
    }

    public function imprimir_ticket(Request $request, $sku){
        $products = Product::where('sku', '=', $sku)->first();

        $pdf = PDF::loadView('pdf.eticketa_productos',compact('products'));
        // Para cambiar la medida se deben pasar milimetros a putnos
        $pdf->setPaper([0, 0,141.732,70.8661], 'portrair');
        return $pdf->download('etiqueta_'.$sku.'.pdf');
    }

    public function search(Request $request){
        $servicio = Taller::where('folio', '=', $request->search)->first();
        $taller_productos = TallerProductos::get();

        if ($servicio) {
            return view('admin.scanner.search_servicio', ['servicio' => $servicio,'taller_productos' => $taller_productos]);
        }

        return response()->json(['error' => 'No se encontraron datos']);
    }

    public function edit_servicio(Request $request, $id){

        $servicio = Taller::find($id);
        $servicio->estatus = $request->get('estado');
        $servicio->marca = $request->get('marca');
        $servicio->modelo = $request->get('modelo');
        $servicio->rodada = $request->get('rodada');
        $servicio->precio_servicio = $request->get('precio_servicio');
        $servicio->subtotal = $request->get('subtotal');
        $servicio->total = $request->get('total');


        $servicio->save(); // Guarda los cambios en la base de datos
        Alert::success('Servicio Editado', 'Se ha editado con exito');
        return redirect()->back();
    }

    public function search_product(Request $request)
    {
        if ($request->ajax()) {
            $output = "";

            $product = Product::where('sku', '=', $request->search)->first();

            $historial_productos_servicios = TallerProductos::where('sku', '=', $product['sku'])->get();

            $historial_productos = ProductoNota::where('id_product_woo', '=', $product['id'])->get();

            $mergedCollection = $historial_productos_servicios->concat($historial_productos);

            if ($product) {
                $fechaHora_creat = $product['date_created'];
                $fechaHora_mod = $product['date_modified'];

                $fecha_create = Carbon::parse($fechaHora_creat)->locale('es')->isoFormat('LL'); // Formato de fecha largo
                $fecha_mod = Carbon::parse($fechaHora_mod)->locale('es')->isoFormat('LL'); // Formato de fecha largo

                $hora_create = Carbon::parse($fechaHora_creat)->format('h:i:s A'); // Formato de hora
                $hora_mod = Carbon::parse($fechaHora_mod)->format('h:i:s A'); // Formato de hora

                // Extract meta_data values
                $clave_mayorista = $this->getMetaDataValue($product, 'clave_mayorista');
                $nombre_del_proveedor = $this->getMetaDataValue($product, 'nombre_del_proveedor');
                $id_proveedor = $this->getMetaDataValue($product, 'id_proveedor');
                $costo = $this->getMetaDataValue($product, 'costo');

                // Build the HTML response for each product
                $output .= view('admin.scanner.index_product', compact(
                    'product',
                    'fecha_create',
                    'fecha_mod',
                    'hora_create',
                    'hora_mod',
                    'clave_mayorista',
                    'nombre_del_proveedor',
                    'id_proveedor',
                    'costo'
                ));

                return view('admin.scanner.show', ['product' => $product, 'output' => $output, 'costo' => $costo,'fecha_create' => $fecha_create,'fecha_mod' => $fecha_mod,'hora_create' => $hora_create,'hora_mod' => $hora_mod,'clave_mayorista' => $clave_mayorista,'nombre_del_proveedor' => $nombre_del_proveedor,'id_proveedor' => $id_proveedor,'mergedCollection' => $mergedCollection,]);
            }

        }
    }

    private function getMetaDataValue($product, $key)
    {
        foreach ($product['meta_data'] as $item) {
            if ($item->key === $key) {
                return $item->value;
            }
        }

        return null;
    }

    public function edit_product(Request $request,$id)
    {
        $products = Product::find($id);
        $products->name = $request->get('name');
        $products->price = $request->get('price');
        $products->sale_price = $request->get('sale_price');
        $products->sku = $request->get('sku');
        $products->stock_quantity = $request->get('stock_quantity');
        $products->id_proveedor = $request->get('id_proveedor');
        $products->nombre_del_proveedor = $request->get('nombre_del_proveedor');
        $products->costo = $request->get('costo');
        $products->clave_mayorista = $request->get('clave_mayorista');

        $data       = [
            'name' => $products->name ,
            'price' => $products->price ,
            'regular_price' => $products->price ,
            'sale_price' => $products->sale_price,
            'sku' => $products->sku,
            'stock_quantity' => $products->stock_quantity,
            "meta_data" => [
                3 => [
                  "key"=> "id_proveedor",
                  "value"=> $products->id_proveedor,
                ],
                4 => [
                  "key"=> "nombre_del_proveedor",
                  "value"=> $products->nombre_del_proveedor,
                ],
                5 => [
                  "key"=> "costo",
                  "value"=> $products->costo,
                ],
                6 => [
                  "key"=> "clave_mayorista",
                  "value"=> $products->clave_mayorista,
                ]
              ]
        ];

        $product = Product::update($id, $data);
        Alert::success('Producto Editado', 'Se ha editado con exito');
        return redirect()->back();
    }

    public function store(request $request){

        return view('admin.scanner.index');
    }

    public function delete_product(Request $request,$id){
        $options = ['force' => true]; // Set force option true for delete permanently. Default value false

        $product = Product::delete($id, $options);
        Alert::warning('Producto Elimindo', 'Se ha eliminados con exito');
        return redirect()->back();
    }
}
