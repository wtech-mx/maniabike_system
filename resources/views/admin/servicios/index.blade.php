@extends('layouts.app_admin')

@section('template_title')
   Servicios
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/servicios_index.css')}}">
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
        background: #fd7e14;
        border-radius: 13px!important;
        margin-bottom: 1rem;
        box-shadow: 10px 10px 33px -24px rgba(255,255,255,1);
    }
    </style>
@endsection

@section('content')
<section class="" style="min-height: 700px;padding: 15px;">

<div class="row">
    <div class="col-12">
        <h2 class="text-left text-white mt-3">Servicios</h2>
    </div>

    <div class="col-12" style="padding: 0!important;">


        <div class="accordion accordion-flush" id="accordionFlushExample">

            <!-- INGRESADO -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-ingresado">
                    <button class="accordion-button collapsed text-white bg-warning btn_rounded_acorde" type="button" data-bs-toggle="collapse" data-bs-target="#flush-INGRESADO" aria-expanded="false" aria-controls="flush-INGRESADO">
                        INGRESADO <img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="">
                    </button>
                </h2>
                <div id="flush-INGRESADO" class="accordion-collapse collapse" aria-labelledby="flush-ingresado" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <table id="myTable" class="" style="width:100%">
                            <thead>
                                <tr class="text-white" style="font-size: 13px;">
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Bici</th>
                                    <th>Fecha</th>
                                    <th>Estat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($servicios as $servicio)
                            <tbody class="text-white">
                                <tr style="font-size: 13px;">
                                    <td>
                                        {{$servicio->id}} <br>
                                        {{$servicio->folio}}
                                    </td>
                                    <td>{{$servicio->Cliente->nombre}} <br><a class="text-white" href="tel:+52{{$servicio->Cliente->telefono}}">{{$servicio->Cliente->telefono}}</a></td>
                                    <td>{{$servicio->marca}} <br> {{$servicio->modelo}}</td>
                                    <td>
                                        @php
                                            $fecha = $servicio->fecha;
                                            $formattedFecha = date('d/m/y', strtotime($fecha));
                                            echo $formattedFecha;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        if ($servicio->estatus == 1 ) {
                                            $servicio->estatus = 'Procesando';
                                        }elseif ($servicio->estatus == 2) {
                                            $servicio->estatus = 'En Espera';
                                        }elseif ($servicio->estatus == 3) {
                                            $servicio->estatus = 'Realizado';
                                        }elseif ($servicio->estatus == 4) {
                                            $servicio->estatus = 'Cancelado';
                                        }elseif ($servicio->estatus == 0) {
                                            $servicio->estatus = 'R ingresado';
                                        }elseif ($servicio->estatus == 5) {
                                            $servicio->estatus = 'Pagado';
                                        }
                                        $fecha = \Carbon\Carbon::parse($servicio->fecha);
                                        $fecha_formateada = $fecha->format('d-m-Y');

                                        @endphp
                                        <a href="" class="" data-bs-toggle="modal" data-bs-target="#modal_estatus{{$servicio->id}}">
                                            @if ($servicio->estatus == 'Procesando' )
                                                <span class="badge rounded-pill custom_badg text-white text-bg-info" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'En Espera')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-danger" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Realizado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-success" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Cancelado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-dark" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'R ingresado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-warning" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Pagado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-light" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_menu{{$servicio->id}}" style="padding:5px">
                                            <i class="fas fa-plus-circle" style="color:#000;font-size: 12px;"></i>
                                        </a>

                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_ticket{{$servicio->id}}" style="padding:5px">
                                            <i class="fa fa-ticket" style="color:#000;font-size: 12px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @include('admin.servicios.modal_estatus')
                            @include('admin.servicios.modal_menu')
                            @include('admin.servicios.modal_ticket')
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>

            <!-- PROCESO -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-proceso">
                    <button class="accordion-button collapsed text-white bg-info btn_rounded_acorde" type="button" data-bs-toggle="collapse" data-bs-target="#flush-PROCESO" aria-expanded="false" aria-controls="flush-PROCESO">
                        PROCESANDO <img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                    </button>
                </h2>
                <div id="flush-PROCESO" class="accordion-collapse collapse" aria-labelledby="flush-proceso" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <table id="myTable2" class="" style="width:100%">
                            <thead>
                                <tr class="text-white" style="font-size: 13px;">
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Bici</th>
                                    <th>Fecha</th>
                                    <th>Estat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($servicios_procesando as $servicio)
                            <tbody class="text-white">
                                <tr style="font-size: 13px;">
                                    <td>
                                        {{$servicio->id}} <br>
                                        {{$servicio->folio}}
                                    </td>
                                    <td>{{$servicio->Cliente->nombre}} <br><a class="text-white" href="tel:+52{{$servicio->Cliente->telefono}}">{{$servicio->Cliente->telefono}}</a></td>
                                    <td>{{$servicio->marca}} <br> {{$servicio->modelo}}</td>
                                    <td>
                                        @php
                                            $fecha = $servicio->fecha;
                                            $formattedFecha = date('d/m/y', strtotime($fecha));
                                            echo $formattedFecha;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        if ($servicio->estatus == 1 ) {
                                            $servicio->estatus = 'Procesando';
                                        }elseif ($servicio->estatus == 2) {
                                            $servicio->estatus = 'En Espera';
                                        }elseif ($servicio->estatus == 3) {
                                            $servicio->estatus = 'Realizado';
                                        }elseif ($servicio->estatus == 4) {
                                            $servicio->estatus = 'Cancelado';
                                        }elseif ($servicio->estatus == 0) {
                                            $servicio->estatus = 'R ingresado';
                                        }elseif ($servicio->estatus == 5) {
                                            $servicio->estatus = 'Pagado';
                                        }
                                        $fecha = \Carbon\Carbon::parse($servicio->fecha);
                                        $fecha_formateada = $fecha->format('d-m-Y');

                                        @endphp
                                        <a href="" class="" data-bs-toggle="modal" data-bs-target="#modal_estatus{{$servicio->id}}">
                                            @if ($servicio->estatus == 'Procesando' )
                                                <span class="badge rounded-pill custom_badg text-white text-bg-info" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'En Espera')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-danger" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Realizado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-success" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Cancelado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-dark" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'R ingresado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-warning" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Pagado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-light" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_menu{{$servicio->id}}" style="padding:5px">
                                            <i class="fas fa-plus-circle" style="color:#000;font-size: 12px;"></i>
                                        </a>

                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_ticket{{$servicio->id}}" style="padding:5px">
                                            <i class="fa fa-ticket" style="color:#000;font-size: 12px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @include('admin.servicios.modal_estatus')
                            @include('admin.servicios.modal_menu')
                            @include('admin.servicios.modal_ticket')
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>

            <!-- ESPERA -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-espera">
                    <button class="accordion-button collapsed text-white bg-danger btn_rounded_acorde" type="button" data-bs-toggle="collapse" data-bs-target="#flush-ESPERA" aria-expanded="false" aria-controls="flush-ESPERA">
                        ESPERA <img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="">
                    </button>
                </h2>
                <div id="flush-ESPERA" class="accordion-collapse collapse" aria-labelledby="flush-espera" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <table id="myTable3" class="" style="width:100%">
                            <thead>
                                <tr class="text-white" style="font-size: 13px;">
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Bici</th>
                                    <th>Fecha</th>
                                    <th>Estat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($servicios_espera as $servicio)
                            <tbody class="text-white">
                                <tr style="font-size: 13px;">
                                    <td>
                                        {{$servicio->id}} <br>
                                        {{$servicio->folio}}
                                    </td>
                                    <td>{{$servicio->Cliente->nombre}} <br><a class="text-white" href="tel:+52{{$servicio->Cliente->telefono}}">{{$servicio->Cliente->telefono}}</a></td>
                                    <td>{{$servicio->marca}} <br> {{$servicio->modelo}}</td>
                                    <td>
                                        @php
                                            $fecha = $servicio->fecha;
                                            $formattedFecha = date('d/m/y', strtotime($fecha));
                                            echo $formattedFecha;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        if ($servicio->estatus == 1 ) {
                                            $servicio->estatus = 'Procesando';
                                        }elseif ($servicio->estatus == 2) {
                                            $servicio->estatus = 'En Espera';
                                        }elseif ($servicio->estatus == 3) {
                                            $servicio->estatus = 'Realizado';
                                        }elseif ($servicio->estatus == 4) {
                                            $servicio->estatus = 'Cancelado';
                                        }elseif ($servicio->estatus == 0) {
                                            $servicio->estatus = 'R ingresado';
                                        }elseif ($servicio->estatus == 5) {
                                            $servicio->estatus = 'Pagado';
                                        }
                                        $fecha = \Carbon\Carbon::parse($servicio->fecha);
                                        $fecha_formateada = $fecha->format('d-m-Y');

                                        @endphp
                                        <a href="" class="" data-bs-toggle="modal" data-bs-target="#modal_estatus{{$servicio->id}}">
                                            @if ($servicio->estatus == 'Procesando' )
                                                <span class="badge rounded-pill custom_badg text-white text-bg-info" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'En Espera')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-danger" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Realizado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-success" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Cancelado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-dark" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'R ingresado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-warning" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Pagado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-light" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_menu{{$servicio->id}}" style="padding:5px">
                                            <i class="fas fa-plus-circle" style="color:#000;font-size: 12px;"></i>
                                        </a>

                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_ticket{{$servicio->id}}" style="padding:5px">
                                            <i class="fa fa-ticket" style="color:#000;font-size: 12px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @include('admin.servicios.modal_estatus')
                            @include('admin.servicios.modal_menu')
                            @include('admin.servicios.modal_ticket')
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>

            <!-- REALIZADO -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-realizado">
                    <button class="accordion-button collapsed text-white bg-success btn_rounded_acorde" type="button" data-bs-toggle="collapse" data-bs-target="#flush-REALIZADO" aria-expanded="false" aria-controls="flush-REALIZADO">
                        REALIZADO <img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/comprobado.png') }}" alt="">
                    </button>
                </h2>
                <div id="flush-REALIZADO" class="accordion-collapse collapse" aria-labelledby="flush-realizado" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <table id="myTable4" class="" style="width:100%">
                            <thead>
                                <tr class="text-white" style="font-size: 13px;">
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Bici</th>
                                    <th>Fecha</th>
                                    <th>Estat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($servicios_realizado as $servicio)
                            <tbody class="text-white">
                                <tr style="font-size: 13px;">
                                    <td>
                                        {{$servicio->id}} <br>
                                        {{$servicio->folio}}
                                    </td>
                                    <td>{{$servicio->Cliente->nombre}} <br><a class="text-white" href="tel:+52{{$servicio->Cliente->telefono}}">{{$servicio->Cliente->telefono}}</a></td>
                                    <td>{{$servicio->marca}} <br> {{$servicio->modelo}}</td>
                                    <td>
                                        @php
                                            $fecha = $servicio->fecha;
                                            $formattedFecha = date('d/m/y', strtotime($fecha));
                                            echo $formattedFecha;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        if ($servicio->estatus == 1 ) {
                                            $servicio->estatus = 'Procesando';
                                        }elseif ($servicio->estatus == 2) {
                                            $servicio->estatus = 'En Espera';
                                        }elseif ($servicio->estatus == 3) {
                                            $servicio->estatus = 'Realizado';
                                        }elseif ($servicio->estatus == 4) {
                                            $servicio->estatus = 'Cancelado';
                                        }elseif ($servicio->estatus == 0) {
                                            $servicio->estatus = 'R ingresado';
                                        }elseif ($servicio->estatus == 5) {
                                            $servicio->estatus = 'Pagado';
                                        }
                                        $fecha = \Carbon\Carbon::parse($servicio->fecha);
                                        $fecha_formateada = $fecha->format('d-m-Y');

                                        @endphp
                                        <a href="" class="" data-bs-toggle="modal" data-bs-target="#modal_estatus{{$servicio->id}}">
                                            @if ($servicio->estatus == 'Procesando' )
                                                <span class="badge rounded-pill custom_badg text-white text-bg-info" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'En Espera')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-danger" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Realizado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-success" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Cancelado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-dark" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'R ingresado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-warning" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Pagado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-light" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_menu{{$servicio->id}}" style="padding:5px">
                                            <i class="fas fa-plus-circle" style="color:#000;font-size: 12px;"></i>
                                        </a>

                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_ticket{{$servicio->id}}" style="padding:5px">
                                            <i class="fa fa-ticket" style="color:#000;font-size: 12px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @include('admin.servicios.modal_estatus')
                            @include('admin.servicios.modal_menu')
                            @include('admin.servicios.modal_ticket')
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>

            <!-- CANCELADO -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-cancelado">
                    <button class="accordion-button collapsed text-white bg-dark btn_rounded_acorde" type="button" data-bs-toggle="collapse" data-bs-target="#flush-CANCELADO" aria-expanded="false" aria-controls="flush-CANCELADO">
                        CANCELADO <img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="">
                    </button>
                </h2>
                <div id="flush-CANCELADO" class="accordion-collapse collapse" aria-labelledby="flush-cancelado" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <table id="myTable5" class="" style="width:100%">
                            <thead>
                                <tr class="text-white" style="font-size: 13px;">
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Bici</th>
                                    <th>Fecha</th>
                                    <th>Estat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($servicios_cancelado as $servicio)
                            <tbody class="text-white">
                                <tr style="font-size: 13px;">
                                    <td>
                                        {{$servicio->id}} <br>
                                        {{$servicio->folio}}
                                    </td>
                                    <td>{{$servicio->Cliente->nombre}} <br><a class="text-white" href="tel:+52{{$servicio->Cliente->telefono}}">{{$servicio->Cliente->telefono}}</a></td>
                                    <td>{{$servicio->marca}} <br> {{$servicio->modelo}}</td>
                                    <td>
                                        @php
                                            $fecha = $servicio->fecha;
                                            $formattedFecha = date('d/m/y', strtotime($fecha));
                                            echo $formattedFecha;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        if ($servicio->estatus == 1 ) {
                                            $servicio->estatus = 'Procesando';
                                        }elseif ($servicio->estatus == 2) {
                                            $servicio->estatus = 'En Espera';
                                        }elseif ($servicio->estatus == 3) {
                                            $servicio->estatus = 'Realizado';
                                        }elseif ($servicio->estatus == 4) {
                                            $servicio->estatus = 'Cancelado';
                                        }elseif ($servicio->estatus == 0) {
                                            $servicio->estatus = 'R ingresado';
                                        }elseif ($servicio->estatus == 5) {
                                            $servicio->estatus = 'Pagado';
                                        }
                                        $fecha = \Carbon\Carbon::parse($servicio->fecha);
                                        $fecha_formateada = $fecha->format('d-m-Y');

                                        @endphp
                                        <a href="" class="" data-bs-toggle="modal" data-bs-target="#modal_estatus{{$servicio->id}}">
                                            @if ($servicio->estatus == 'Procesando' )
                                                <span class="badge rounded-pill custom_badg text-white text-bg-info" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'En Espera')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-danger" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Realizado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-success" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Cancelado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-dark" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'R ingresado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-warning" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Pagado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-light" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_menu{{$servicio->id}}" style="padding:5px">
                                            <i class="fas fa-plus-circle" style="color:#000;font-size: 12px;"></i>
                                        </a>

                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_ticket{{$servicio->id}}" style="padding:5px">
                                            <i class="fa fa-ticket" style="color:#000;font-size: 12px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @include('admin.servicios.modal_estatus')
                            @include('admin.servicios.modal_menu')
                            @include('admin.servicios.modal_ticket')
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>

            <!-- PAGADO -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-pagado">
                    <button class="accordion-button collapsed text-dark bg-light btn_rounded_acorde" type="button" data-bs-toggle="collapse" data-bs-target="#flush-PAGADO" aria-expanded="false" aria-controls="flush-PAGADO">
                        PAGADO <img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="">
                    </button>
                </h2>
                <div id="flush-PAGADO" class="accordion-collapse collapse" aria-labelledby="flush-pagado" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <table id="myTable6" class="" style="width:100%">
                            <thead>
                                <tr class="text-white" style="font-size: 13px;">
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Bici</th>
                                    <th>Fecha</th>
                                    <th>Estat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($servicios_pagado as $servicio)
                            <tbody class="text-white">
                                <tr style="font-size: 13px;">
                                    <td>
                                        {{$servicio->id}} <br>
                                        {{$servicio->folio}}
                                    </td>
                                    <td>{{$servicio->Cliente->nombre}} <br><a class="text-white" href="tel:+52{{$servicio->Cliente->telefono}}">{{$servicio->Cliente->telefono}}</a></td>
                                    <td>{{$servicio->marca}} <br> {{$servicio->modelo}}</td>
                                    <td>
                                        @php
                                            $fecha = $servicio->fecha;
                                            $formattedFecha = date('d/m/y', strtotime($fecha));
                                            echo $formattedFecha;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        if ($servicio->estatus == 1 ) {
                                            $servicio->estatus = 'Procesando';
                                        }elseif ($servicio->estatus == 2) {
                                            $servicio->estatus = 'En Espera';
                                        }elseif ($servicio->estatus == 3) {
                                            $servicio->estatus = 'Realizado';
                                        }elseif ($servicio->estatus == 4) {
                                            $servicio->estatus = 'Cancelado';
                                        }elseif ($servicio->estatus == 0) {
                                            $servicio->estatus = 'R ingresado';
                                        }elseif ($servicio->estatus == 5) {
                                            $servicio->estatus = 'Pagado';
                                        }
                                        $fecha = \Carbon\Carbon::parse($servicio->fecha);
                                        $fecha_formateada = $fecha->format('d-m-Y');

                                        @endphp
                                        <a href="" class="" data-bs-toggle="modal" data-bs-target="#modal_estatus{{$servicio->id}}">
                                            @if ($servicio->estatus == 'Procesando' )
                                                <span class="badge rounded-pill custom_badg text-white text-bg-info" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'En Espera')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-danger" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Realizado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-success" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Cancelado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-dark" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'R ingresado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-warning" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @elseif ($servicio->estatus == 'Pagado')
                                                <span class="badge rounded-pill custom_badg text-white text-bg-light" style="padding: 10px;width: 10px;height: 10px;color: transparent!important;margin-left:5px;">-</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_menu{{$servicio->id}}" style="padding:5px">
                                            <i class="fas fa-plus-circle" style="color:#000;font-size: 12px;"></i>
                                        </a>

                                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_ticket{{$servicio->id}}" style="padding:5px">
                                            <i class="fa fa-ticket" style="color:#000;font-size: 12px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @include('admin.servicios.modal_estatus')
                            @include('admin.servicios.modal_menu')
                            @include('admin.servicios.modal_ticket')
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>

        </div>

</div>

</section>

@endsection

@section('columna_4')
    <p class="text-center">
        <a class="btn_back" href="{{ route('taller.create') }}" >
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
        $('#myTable2').DataTable();
            responsive: true
    });

    $(document).ready(function () {
        $('#myTable3').DataTable();
            responsive: true
    });

    $(document).ready(function () {
        $('#myTable4').DataTable();
            responsive: true
    });

    $(document).ready(function () {
        $('#myTable5').DataTable();
            responsive: true
    });

    $(document).ready(function () {
        $('#myTable6').DataTable();
            responsive: true
    });
</script>
@endsection
