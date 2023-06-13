<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;
use Session;
use Codexshaper\WooCommerce\Facades\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;
use App\Models\ProductoNota;
use App\Models\Cliente;


class CajaController extends Controller
{
    public function index()
    {
    return view('admin.caja.index');
    }

        public function caja_search(Request $request)
        {
            $fechaActual = date('Y-m-d');
            $clientes = Cliente::get();

            if ($request->ajax()) {
                $output = "";
                $productos = $request->productos;
                $products = [];
                $total = 0;

                $output .= '<form class="row" method="POST" action="'. route('caja.store') .'" enctype="multipart/form-data" role="form">' .
                '<input type="hidden" name="_token" value="'. csrf_token() .'" />'.
                '<div class="col-9 form-group ">' .
                    '<label for="" class="form-control-label label_form_custom">Selecciona cliente y/o agrega uno </label>' .
                    '<div class="input-group input-group-alternative mb-4">' .
                        '<span class="input-group-text" style="border-radius: 16px 0 0px 0px!important;">' .
                            '<img class="img_icon_form" src="' . asset('assets/admin/img/icons/biker.png'). '" alt="">' .
                        '</span>' .
                        '<select class="form-control cliente" data-toggle="select" id="id_client" name="id_client">' .
                            '<option value="">Seleccionar cliente</option>';

                foreach ($clientes as $cliente) {
                    $output .= '<option value="' . $cliente->id . '">' . $cliente->nombre . '</option>';
                }

                $output .= '</select>' .
                    '<button class="btn btn-secondary btn-sm btn_plus_service" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">' .
                        '<i class="fas fa-plus-circle"></i>' .
                    '</button>' .
                    '</div>' .
                    '<div class="form-group ">' .
                        '<div class="collapse" id="collapseExample">' .
                            '<div class="card card-body collapse_adduser" style="background: transparent;">' .
                                '<div class="row">' .
                                '<div class="col-6">' .
                                    '<div class="form-group">' .
                                        '<label for="nombre">Nombre *</label>' .
                                        '<input  id="nombre" name="nombre" type="text" class="form-control">' .
                                    '</div>' .
                                '</div>' .
                                '<div class="col-6">' .
                                    '<div class="form-group">' .
                                        '<label for="nombre">Telefono *</label>' .
                                        '<input  id="telefono" name="telefono" type="number" class="form-control">' .
                                    '</div>' .
                                '</div>' .
                                '<div class="col-12">' .
                                    '<div class="form-group">' .
                                        '<label for="nombre">Correo</label>' .
                                        '<input  id="email" name="email" type="email" class="form-control">' .
                                    '</div>' .
                                '</div>' .
                                '</div>' .
                            '</div>' .
                        '</div>' .
                    '</div>' .
                '</div>' .
                '<div class="col-3">' .
                '<p class=""><strong class="">Fecha : </strong></span></p>' .
                '<input class="form-control" type="date" name="fecha" id="fecha" value="' . $fechaActual . '">' .
                '</div>' .
                '</div>';

                foreach ($productos as $producto) {
                    $product = Product::where('sku', $producto)->first();

                    if ($product) {
                        $products[] = $product;
                        $subtotal = 0;

                        $output .=
                            '<div class="col-6">' .
                            '<p class=""><strong class="">Nombre:  </strong> <br>' . $product['name'] . '<br><strong class="">' . $product['sku'] . '</strong></p>' .
                            '</div>' .
                            '<input class="form-control" type="hidden" name="id_product[]" id="id_product" value="' . $product['id'] . '">' .
                            '<div class="col-3">' .
                            '<p class=""><strong class="">Cantidad:  </strong> <br></p>' .
                            '<input class="form-control cantidad" type="number" name="cantidad" id="cantidad" value="1">' .
                            '</div>' .
                            '<div class="col-3">' .
                            '<p class=""><strong class="">Precio:  </strong> <br></p>' .
                            '<input class="form-control price" type="number" name="price" id="price" value="' . $product['price'] . '">' .
                            '</div>';

                        $total += $subtotal;
                    }
                }

                $output .= '<div class="col-6">' .
                    '</div>' .
                    '<div class="col-3">' .
                    '<p class=""><strong class="">Tipo :</strong></span></p>' .
                    '<select class="form-select" name="tipo" id="tipo">' .
                    '<option selected>Ninguno</option>' .
                    '<option value="Porcentaje">Porcentaje</option>' .
                    '<option value="Fijo">Fijo</option>' .
                    '</select>' .
                    '</div>' .
                    '<div class="col-3">' .
                    '<p class=""><strong class="">Descuento: </strong></span></p>' .
                    '<input class="form-control" type="number" name="descuento" id="descuento" value="0">' .
                    '</div>' .
                    '<div class="col-12">' .
                    '<p class=""><strong class="">Método de pago : </strong></span></p>' .
                    '<select class="form-select" name="metodo_pago" id="metodo_pago">' .
                    '<option selected>Selecciona Método de Pago</option>' .
                    '<option value="Efectivo">Efectivo</option>' .
                    '<option value="Tarjeta">Tarjeta crédito/débito</option>' .
                    '<option value="Transferencia">Transferencia</option>' .
                    '</select>' .
                    '</div>' .
                    '<div class="col-12">' .
                    '<p class=""><strong class="">Comentario : </strong></span></p>' .
                    '<textarea class="form-control" name="comentario" id="comentario" rows="2"></textarea>' .
                    '</div>' .
                    '<div class="col-12">' .
                    '<p class=""><strong class="">Comprobante : </strong></span></p>' .
                    '<input class="form-control" type="file" name="comprobante" id="comprobante" value="">' .
                    '</div>' .
                    '<div class="col-6 mt-2">' .
                    '<p class=""><strong class="">Total: </strong><span class="total"></span></p>' .
                    '<button id="btnCalcular" class="btn btn-primary" type="button">Calcular</button>' .
                    '<button type="submit" class="btn btn-primary">Guardar</button>'.
                    '</div>' .
                    '<div class="col-3 mt-2">' .
                    '<p class=""><strong class="">Subtotal : </strong></span></p>' .
                    '<input class="form-control" type="number" name="subtotal" id="subtotal" value="">' .
                    '</div>' .
                    '<div class="col-3 mt-2">' .
                    '<p class=""><strong class="">Total : </strong></span></p>' .
                    '<input class="form-control" type="number" name="total" id="total" value="">' .
                    '</div>' .
                    '</div>' .
                    '</form>';

                return response()->json($output);
            }
        }

        public function store(Request $request)
        {

            // N U E V O  U S U A R I O
            if($request->get('nombre') != NULL){
            $client = new Cliente;
            $client->nombre = $request->get('nombre');
            $client->telefono = $request->get('telefono');
            $client->email = $request->get('email');
            $client->save();
            }


            // G U A R D A R  N O T A  P R I N C I P A L
            $caja = new Caja;
            if($request->get('nombre') != NULL){
                $caja->id_client = $client->id;
            }else{
                $caja->id_client = $request->get('id_client');
            }

            $caja->fecha = $request->get('fecha');
            $caja->tipo = $request->get('tipo');
            $caja->descuento = $request->get('descuento');
            $caja->metodo_pago = $request->get('metodo_pago');
            $caja->comentario = $request->get('comentario');
            $caja->comprobante = $request->get('comprobante');
            $caja->subtotal = $request->get('subtotal');
            $caja->total = $request->get('total');
            $caja->save();

                // Guardar Productos en ProductoNota
                $productos = $request->get('id_product');

                for ($i = 0; $i < count($productos); $i++) {
                    $product_nota = new ProductoNota;
                    $product_nota->id_product_woo = $productos[$i];
                    $product_nota->id_nota = $caja->id;
                    $product_nota->save();
                }

            Alert::success('Nota Realizada', 'Nota realizada con exito');
            return redirect()->route('index.caja')
                ->with('success', 'Caja Creado.');
        }

}

