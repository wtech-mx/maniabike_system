<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codexshaper\WooCommerce\Facades\WooCommerce;
use RealRashid\SweetAlert\Facades\Alert;
use Codexshaper\WooCommerce\Facades\Product;
use Session;


class WooController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'regular_price' => 'required',
            'description' => '',
            'sku' => '',
        ]);

        $data = [
            'name' => '',
            'type' => '',
            'price' => ''
            'regular_price' => '',
            'sku' => ''
            'description' => '',
            'short_description' => '',
            'images' => [
                [
                    'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
                ],
            ]
        ];

        print_r($woocommerce->post('products', $data));


         Alert::success('Producto creado', 'Se ha guardado con exito');
         return redirect()->back();

    }
}
