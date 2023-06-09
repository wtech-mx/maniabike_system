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

            foreach ($productos as $producto) {
                $product = Product::where('sku', $producto)->first();

                if ($product) {
                    $products[] = $product;

                    $output .=
                        '<form class="row">' .
                        '<div class="col-6">' .
                        '<p class=""><strong class="">Nombre:  </strong> <br>' . $product['name'] . '<br><strong class="">' . $product['sku'] . '</strong></p>' .
                        '</div>' .
                        '<input class="form-control" type="hidden" id="id" name="id" value="' . $product['id'] . '">'.
                        '<div class="col-3">' .
                        '<p class=""><strong class="">Cantidad:  </strong> <br></p>' .
                        '<input class="form-control" type="number" id="cantidad" name="cantidad">'.
                        '</div>' .
                        '<div class="col-3">' .
                        '<p class=""><strong class="">Precio:  </strong> <br></p>' .
                        '<input class="form-control" type="number" id="price" name="price" value="' . $product['price'] . '">'.
                        '</div>' .
                        '</form>';
                }
            }

            return response()->json($output);
        }
    }




}

