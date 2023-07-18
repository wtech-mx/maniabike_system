@extends('layouts.app_admin')

@section('template_title')
    Ordernes
@endsection

@section('css')
    @php
        use Carbon\Carbon;
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
    </style>
@endsection


@section('content')
<section class="" style="min-height: 800px;padding: 15px;">

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <h2 class="text-left text-white mt-3">Order</h2>
                <a href="{{ route('index.caja') }}" style="background-color: #fff;border-radius:13px;padding:5px;">
                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/point-of-sale.png') }}" alt="">
                </a>
            </div>
        </div>

            <div class="col-12" style="padding: 0!important;">
                @can('client-list')
                    <table class="responsive" id="myTable" class="" style="width:100%">
                        <thead class="thead  text-white">
                            <tr>
                                <th class="text-white" style="font-size: 10px;">Id</th>
                                <th class="text-white" style="font-size: 10px;">Nombre</th>
                                <th class="text-white" style="font-size: 10px;">Met. Pago</th>
                                <th class="text-white" style="font-size: 10px;">Total</th>
                                <th class="text-white" style="font-size: 10px;">Fecha</th>
                                <th class="text-white" style="font-size: 10px;">Acciones</th>
                            </tr>
                        </thead>|
                        <tbody>
                            @foreach ($orders as $order)
                                    <td class="text-white" style="font-size: 10px;">{{$order->billing->first_name}} <br>
                                        {{$order->id}}
                                    </td>
                                    <td class="text-white" style="font-size: 10px;">{{$order->billing->first_name}} <br>
                                        {{$order->billing->phone}}
                                    </td>
                                    <td class="text-white" style="font-size: 10px;">{{$order->payment_method}}</td>
                                    <td class="text-white" style="font-size: 10px;">{{$order->total}}</td>
                                    @php
                                        $fecha = $order->date_completed;
                                        $fechaFormateada = Carbon::parse($fecha)->format('d/m/y');
                                    @endphp
                                    <td class="text-white" style="font-size: 10px;">{{$fechaFormateada}}</td>
                                    <td>
                                        <a href="https://api.whatsapp.com/send?phone=+52{{$order->billing->phone}}&text=Hola,%20este%20es%20mi%20pedido.%20¿Podrían%20ayudarme%20con%20esto?%0A%0A{{ route('notas.edit', $order->id) }}" target="_blank" class="btn btn-success btn-sm">
                                            <i class="fa fa-send"></i>
                                        </a>
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

