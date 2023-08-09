@extends('layouts.app_admin')

@section('template_title')
    Inventario
@endsection

@section('css')

    @php
        use Carbon\Carbon;
        use \Milon\Barcode\DNS1D;
    @endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">

    <style>
        .modal-dialog {
            margin-left: 0!important;
        }

        .modal-dialog {
            width: 80%!important;;
        }

        #reader {
            width: 400px;
        }
        .btn_rounded_acorde{
        border-radius: 13px!important;
        margin-bottom: 1rem;
        box-shadow: 10px 10px 33px -24px rgba(255,255,255,1);
        }

        .image_label_estatus{
            width: 60px;
        }
    </style>
@endsection


@section('content')
<section class="" style="min-height: 800px;padding: 15px;">

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <h2 class="text-left text-white mt-3 mb-5">Inventario</h2>
            </div>
        </div>

            <div class="col-12" style="padding: 0!important;">
                @can('client-list')
                <div class="accordion" id="accordionExample">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button collapsed text-white bg-dark btn_rounded_acorde d-block" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecero" aria-expanded="true" aria-controls="collapsecero">
                              <div class="d-flex justify-content-between">
                                  <h3 class="text-white">Sin Stock </h3>
                                  <img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/vendido.png') }}" alt="">
                              </div>
                          </button>
                        </h2>
                        <div id="collapsecero" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                              <table class="responsive" id="myTable" class="" style="width:100%">
                                  <thead class="thead  text-white">
                                      <tr>
                                          <th class="text-white" style="font-size: 10px;">Stock</th>
                                          <th class="text-white" style="font-size: 10px;">SKU</th>
                                          <th class="text-white" style="font-size: 10px;">Nombre</th>
                                          <th class="text-white" style="font-size: 10px;">Proveedor</th>
                                          <th class="text-white" style="font-size: 10px;">Acciones</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($outStockProducts as $item)
                                      @php
                                      $imageSrc = $item['images'][0]['src'];

                                      $clave_mayorista = null;
                                      $nombre_del_proveedor = null;
                                      $costo = null;
                                      $id_proveedor = null;


                                     foreach ($item['meta_data'] as $valor) {
                                         if ($valor['key'] === 'clave_mayorista') {
                                             $clave_mayorista = $valor['value'];
                                             break;
                                         }
                                     }
                                     foreach ($item['meta_data'] as $valor) {
                                         if ($valor['key'] === 'nombre_del_proveedor') {
                                             $nombre_del_proveedor = $valor['value'];
                                             break;
                                         }
                                     }
                                     foreach ($item['meta_data'] as $valor) {
                                         if ($valor['key'] === 'id_proveedor') {
                                             $id_proveedor = $valor['value'];
                                             break;
                                         }
                                     }
                                     foreach ($item['meta_data'] as $valor) {
                                         if ($valor['key'] === 'costo') {
                                             $costo = $valor['value'];
                                             break;
                                         }
                                     }
                                     @endphp
                                      <tr>
                                          <td>
                                              {{ $item['stock_quantity'] }}
                                          </td>
                                          <td>
                                              {{ $item['sku'] }}
                                          </td>

                                          <td>
                                              {{ $item['name'] }}
                                          </td>
                                          <td>
                                            {{ $nombre_del_proveedor }}
                                        </td>
                                          <td>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#manual_update_{{ $item['id'] }}">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                          </td>
                                      </tr>
                                      @include('admin.inventario.modal_update')
                                  @endforeach
                                  </tbody>
                              </table>
                          </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button  text-white bg-danger btn_rounded_acorde d-block" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="d-flex justify-content-between">
                                <h3 class="text-white">Bajo Stock </h3>
                                <img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/devolucion-de-producto.png') }}" alt="">
                            </div>
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="responsive" id="myTable1" class="" style="width:100%">
                                <thead class="thead  text-white">
                                    <tr>
                                        <th class="text-white" style="font-size: 10px;">Stock</th>
                                        <th class="text-white" style="font-size: 10px;">SKU</th>
                                        <th class="text-white" style="font-size: 10px;">Nombre</th>
                                        <th class="text-white" style="font-size: 10px;">Proveedor</th>
                                        <th class="text-white" style="font-size: 10px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lowStockProducts as $item)

                                    @php
                                    $imageSrc = $item['images'][0]['src'];

                                    $clave_mayorista = null;
                                    $nombre_del_proveedor = null;
                                    $costo = null;
                                    $id_proveedor = null;


                                   foreach ($item['meta_data'] as $valor) {
                                       if ($valor['key'] === 'clave_mayorista') {
                                           $clave_mayorista = $valor['value'];
                                           break;
                                       }
                                   }
                                   foreach ($item['meta_data'] as $valor) {
                                       if ($valor['key'] === 'nombre_del_proveedor') {
                                           $nombre_del_proveedor = $valor['value'];
                                           break;
                                       }
                                   }
                                   foreach ($item['meta_data'] as $valor) {
                                       if ($valor['key'] === 'id_proveedor') {
                                           $id_proveedor = $valor['value'];
                                           break;
                                       }
                                   }
                                   foreach ($item['meta_data'] as $valor) {
                                       if ($valor['key'] === 'costo') {
                                           $costo = $valor['value'];
                                           break;
                                       }
                                   }
                                   @endphp

                                    <tr>
                                        <td>
                                            {{ $item['stock_quantity'] }}
                                        </td>
                                        <td>
                                            {{ $item['sku'] }}
                                        </td>
                                        <td>
                                            {{ $item['name'] }}
                                        </td>
                                        <td>
                                            {{ $nombre_del_proveedor }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#manual_update_{{ $item['id'] }}">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('admin.inventario.modal_update')

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button text-white bg-warning btn_rounded_acorde d-block" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <div class="d-flex justify-content-between">
                                <h3 class="text-white">Medio Stock</h3>
                                <img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stock-limitado.png') }}" alt="">
                            </div>
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="responsive" id="myTable2" class="" style="width:100%">
                                <thead class="thead  text-white">
                                    <tr>
                                        <th class="text-white" style="font-size: 10px;">Stock</th>
                                        <th class="text-white" style="font-size: 10px;">SKU</th>
                                        <th class="text-white" style="font-size: 10px;">Nombre</th>
                                        <th class="text-white" style="font-size: 10px;">Proveedor</th>
                                        <th class="text-white" style="font-size: 10px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($middleStockProducts as $item)
                                    @php
                                    $imageSrc = $item['images'][0]['src'];

                                    $clave_mayorista = null;
                                    $nombre_del_proveedor = null;
                                    $costo = null;
                                    $id_proveedor = null;


                                   foreach ($item['meta_data'] as $valor) {
                                       if ($valor['key'] === 'clave_mayorista') {
                                           $clave_mayorista = $valor['value'];
                                           break;
                                       }
                                   }
                                   foreach ($item['meta_data'] as $valor) {
                                       if ($valor['key'] === 'nombre_del_proveedor') {
                                           $nombre_del_proveedor = $valor['value'];
                                           break;
                                       }
                                   }
                                   foreach ($item['meta_data'] as $valor) {
                                       if ($valor['key'] === 'id_proveedor') {
                                           $id_proveedor = $valor['value'];
                                           break;
                                       }
                                   }
                                   foreach ($item['meta_data'] as $valor) {
                                       if ($valor['key'] === 'costo') {
                                           $costo = $valor['value'];
                                           break;
                                       }
                                   }
                                   @endphp
                                    <tr>
                                        <td>
                                            {{ $item['stock_quantity'] }}
                                        </td>
                                        <td>
                                            {{ $item['sku'] }}
                                        </td>

                                        <td>
                                            {{ $item['name'] }}
                                        </td>
                                        <td>
                                            {{ $nombre_del_proveedor }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#manual_update_{{ $item['id'] }}">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    @include('admin.inventario.modal_update')
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>

                  </div>

                    @else
                    <h2 class="text-center text-white mt-3">No tienes Permiso Para ver esta vista.</h2>
                @endcan
            </div>
        </div>
    </section>



@endsection

@section('columna_4')
    <p class="text-center">
        <a class="btn_back" href="" data-bs-toggle="modal" data-bs-target="#modal_creat_user">
            <i class="fas fa-plus-circle"></i>
        </a>
    </p>
@endsection


@section('select2')

<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>
{{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> --}}

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
        $('#myTable').DataTable();
            responsive: true
        });

        $(document).ready(function () {
        $('#myTable1').DataTable();
            responsive: true
        });

        $(document).ready(function () {
        $('#myTable2').DataTable();
            responsive: true
        });
    </script>



@endsection

