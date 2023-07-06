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
        $products = []; // Inicializar un arreglo vacío para almacenar los productos

        foreach ($productosSeleccionados as $producto) {
            $product = Product::where('sku', $producto)->first(); // Obtener el producto por SKU
            if ($product) {
                $products[] = $product; // Agregar el producto al arreglo
            }
        }

        // Generar el contenido del PDF utilizando los datos obtenidos
        $pdf = PDF::loadView('pdf.productos', ['productos' => $products]);

        // Guardar el PDF en el servidor (opcional)
        $pdf->save(public_path('pdf/nombre-archivo.pdf'));

        // Descargar o abrir el PDF en una nueva ventana
        return $pdf->stream('productos.pdf');
    }

}

