<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Codexshaper\WooCommerce\Facades\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;

class CajaController extends Controller
{
    public function index()
    {
    return view('admin.caja.index');
    }
    public function caja_search(Request $request)
    {
        $fechaActual = date('Y-m-d');

        if ($request->ajax()) {
            $output = "";
            $productos = $request->productos;
            $products = [];
            $total = 0;

            foreach ($productos as $producto) {
                $product = Product::where('sku', $producto)->first();

                $output .= '<div class="row">' .
                '<div class="col-9">' .
                '</div>' .
                '<div class="col-3">' .
                '<p class=""><strong class="">Fecha : </strong></span></p>' .
                '<input class="form-control" type="date" name="fecha" id="fecha" value="' . $fechaActual . '">' .
                '</div>' .
                '</div>';


                if ($product) {
                    $products[] = $product;
                    $subtotal = 0;

                    $output .=
                        '<form class="row">' .
                        '<div class="col-6">' .
                        '<p class=""><strong class="">Nombre:  </strong> <br>' . $product['name'] . '<br><strong class="">' . $product['sku'] . '</strong></p>' .
                        '</div>' .
                        '<input class="form-control" type="hidden" name="id" id="id" value="' . $product['id'] . '">' .
                        '<div class="col-3">' .
                        '<p class=""><strong class="">Cantidad:  </strong> <br></p>' .
                        '<input class="form-control cantidad" type="number" name="cantidad" id="cantidad" value="1">' .
                        '</div>' .
                        '<div class="col-3">' .
                        '<p class=""><strong class="">Precio:  </strong> <br></p>' .
                        '<input class="form-control price" type="number" name="price" id="price" value="' . $product['price'] . '">' .
                        '</div>' .
                        '</form>';

                    $total += $subtotal;
                }
            }

            $output .= '<div class="row">' .
                '<div class="col-6">' .
                '<button id="btnCalcular" class="btn btn-primary">Calcular</button>'.
                '<p class=""><strong class="">Total: </strong><span class="total"></span></p>' .
                '</div>' .
                '<div class="col-3">' .
                '<p class=""><strong class="">Tipo : </strong></span></p>' .
                '<select class="form-select" name="tipo" id="tipo">' .
                '<option selected>Ninguno</option>' .
                '<option value="Porcentaje">Porcentaje</option>' .
                '<option value="Fijo">Fijo</option>' .
                '</select>' .
                '</div>' .
                '<div class="col-3">' .
                '<p class=""><strong class="">Descuento : </strong></span></p>' .
                '<input class="form-control" type="number" name="descuento" id="descuento" value="">' .
                '</div>' .
                '<div class="col-12">' .
                '<p class=""><strong class="">Comentario : </strong></span></p>' .
                '<textarea class="form-control" name="comentario" id="comentario" rows="3"></textarea>'.
                '</div>' .
                '<div class="col-12">' .
                '<p class=""><strong class="">Comprobante : </strong></span></p>' .
                '<input class="form-control" type="file" name="comprobante" id="comprobante" value="">' .
                '</div>' .
                '<div class="col-6">' .
                '</div>' .
                '<div class="col-3">' .
                '<p class=""><strong class="">Subtotal : </strong></span></p>' .
                '<input class="form-control" type="number" name="subtotal" id="subtotal" value="">' .
                '</div>' .
                '<div class="col-3">' .
                '<p class=""><strong class="">Total : </strong></span></p>' .
                '<input class="form-control" type="number" name="total" id="total" value="">' .
                '</div>' .
                '</div>';

            return response()->json($output);
        }
    }


}

