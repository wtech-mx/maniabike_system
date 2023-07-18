@extends('layouts.app_admin')

@section('template_title')
    Ordernes
@endsection

@section('css')
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
    </style>
@endsection


@section('content')
<section class="" style="min-height: 800px;padding: 15px;">

    <div class="row">
        <div class="col-12">
            <h2 class="text-left text-white mt-3">Order</h2>
        </div>

            <div class="col-12" style="padding: 0!important;">
                @can('client-list')
                    <table id="myTable" class="" style="width:100%">
                        <thead class="thead  text-white">
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Total</th>
                                <th>Met. Pago</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->billing->first_name}}</td>
                                    <td>{{$order->billing->phone}}</td>
                                    <td>{{$order->total}}</td>
                                    <td>{{$order->payment_method}}</td>
                                    <td>
                                        <a href="mailto:{{$order->billing->email}}?subject=Reenvío de Orden de Compra">Reenviar Orden</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    </script>
@endsection

