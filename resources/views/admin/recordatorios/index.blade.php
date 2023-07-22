@extends('layouts.app_admin')

@section('template_title')
    Recordatorios
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
                <h2 class="text-left text-white mt-3">nota</h2>
                <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#recordatorio">
                     Crear
                </a>
            </div>
        </div>

            <div class="col-12" style="padding: 0!important;">
                @can('client-list')
                    <table class="responsive" id="myTable" class="" style="width:100%">
                        <thead class="thead  text-white">
                            <tr>
                                <th class="text-white" style="font-size: 10px;">Id</th>
                                <th class="text-white" style="font-size: 10px;">Cliente</th>
                                <th class="text-white" style="font-size: 10px;">Fecha</th>
                                <th class="text-white" style="font-size: 10px;">Estatus</th>
                                <th class="text-white" style="font-size: 10px;">Acciones</th>
                            </tr>
                        </thead>|
                        <tbody>
                            @foreach ($recordatorios as $recordatorio)
                                    <td class="text-white" style="font-size: 10px;">{{$recordatorio->id}}</td>
                                    <td class="text-white" style="font-size: 10px;">{{$recordatorio->cliente}}</td>
                                    @php
                                        $fecha = $recordatorio->fecha;
                                        $fechaFormateada = Carbon::parse($fecha)->format('d/m/y');
                                    @endphp
                                    <td class="text-white" style="font-size: 10px;">{{$fechaFormateada}}</td>
                                    <td class="text-white" style="font-size: 10px;">{{$recordatorio->estatus}}</td>
                                    <td>
                                        <a type="button" class="text-white"  data-bs-toggle="modal" data-bs-target="#recordatorio_{{$recordatorio->id}}">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            @include('admin.recordatorios.modal_edit')
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h2 class="text-center text-white mt-3">No tienes Permiso Para ver esta vista.</h2>
                @endcan
            </div>
        </div>
    </section>

@include('admin.recordatorios.modal_create')

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

