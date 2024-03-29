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
        $productosSeleccionados = $request->input('productos_seleccionados');
        $products = []; // Inicializar un arreglo vacío para almacenar los productos
        $fechaActual = date('Y-m-d');
        foreach ($productosSeleccionados as $producto) {
            $product = Product::where('sku', $producto)->first(); // Obtener el producto por SKU
            if ($product) {
                $products[] = $product; // Agregar el producto al arreglo
            }
        }

        $dominio = $request->getHost();
        if($dominio == 'taller.maniabikes.com.mx'){
            $pdf_productos = base_path('../public_html/taller/pdf');

        }else{
            $pdf_productos = public_path() . '/pdf';
        }

        $path = $pdf_productos;

        if($request->input('tipo') == 'Minorista'){
            // Generar el contenido del PDF utilizando los datos obtenidos
            $pdf = PDF::loadView('pdf.productos', ['productos' => $products]);
            // Guardar el PDF en el servidor (opcional)
          //  $pdf->save($path.'/productos.pdf');
            // $pdf->save(public_path('pdf/productos.pdf'));
            // Descargar o abrir el PDF en una nueva ventana
            return $pdf->download('productos_mino_' . $fechaActual  .'.pdf');
        }else{
            // Generar el contenido del PDF utilizando los datos obtenidos
            $pdf = PDF::loadView('pdf.prodcutos_mayoreo', ['productos' => $products]);
            // Guardar el PDF en el servidor (opcional)
       //     $pdf->save($path.'/productos_mayoreo.pdf');
            // $pdf->save(public_path('pdf/productos_mayoreo.pdf'));
            // Descargar o abrir el PDF en una nueva ventana
            return $pdf->download('productos_mayo_' . $fechaActual  .'.pdf');
        }
    }



}

