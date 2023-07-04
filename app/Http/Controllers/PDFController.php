<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Codexshaper\WooCommerce\Facades\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class PDFController extends Controller
{
    public function generarPDF(Request $request)
    {
        $productosSeleccionados = $request->input('productos');
        foreach ($productosSeleccionados as $producto) {
            $products = Product::where('sku', $producto)->first();
        }
        dd($products);

        // Obtener los datos necesarios para el PDF utilizando los productos seleccionados
        // Generar el contenido del PDF utilizando los datos obtenidos
        $pdf = PDF::loadView('pdf.productos', ['productos' => $products]);

        // Puedes guardar el PDF en el servidor
        // $pdf->save(storage_path('app/public/pdf/nombre-archivo.pdf'));

        // O puedes enviarlo al navegador para descargarlo directamente
        return $pdf->download('productos.pdf');
    }
}

