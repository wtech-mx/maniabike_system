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
        if ($request->ajax()) {
            $output = "";
            $productos = $request->productos;
            $products = [];
            $total = 0;

            foreach ($productos as $producto) {
                $product = Product::where('sku', $producto)->first();

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
                '<p class=""><strong class="">Total: </strong><span class="total"></span></p>' .
                '</div>' .
                '<div class="col-6">' .
                '<p class=""><strong class="">Confirmar el total: </strong></span></p>' .
                '<input class="form-control" type="number" name="total" id="total" value="">' .
                '</div>' .
                '</div>';

            return response()->json($output);
        }
    }





}

