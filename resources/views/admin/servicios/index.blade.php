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
</style>
@endsection

@section('content')
<section class="" style="min-height: 700px;padding: 15px;">

<div class="row">
    <div class="col-12">
        <h2 class="text-left text-white mt-3">Servicios</h2>
    </div>

    <div class="col-12 mt-3 mb-3" style="padding: 0;">
        <div class="d-flex justify-content-between">
            <span class="badge rounded-pill text-white text-bg-warning">Ingre...</span>
            <span class="badge rounded-pill text-white text-bg-info">Proceso</span>
            <span class="badge rounded-pill text-white text-bg-danger">Espera</span>
            <span class="badge rounded-pill text-white text-bg-success">Reali...</span>
            <span class="badge rounded-pill text-white text-bg-dark">Cancel</span>
        </div>
    </div>

    <div class="col-12" style="padding: 0!important;">
        <table id="myTable" class="" style="width:100%">
            <thead>
                <tr class="text-white" style="font-size: 10px;">
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Bicicleta</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($servicios as $servicio)
            <tbody class="text-white">
                <tr style="font-size: 9px;">
                    <td>{{$servicio->id}}</td>
                    <td>{{$servicio->Cliente->nombre}} <br><a class="text-white" href="tel:+52{{$servicio->Cliente->telefono}}">{{$servicio->Cliente->telefono}}</a></td>
                    <td>{{$servicio->marca}} <br> {{$servicio->modelo}}</td>
                    <td>{{$servicio->fecha}}</td>
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
                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_menu{{$servicio->id}}">
                            <i class="fas fa-plus-circle" style="color:#000;font-size: 20px;"></i>
                        </a>

                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_ticket{{$servicio->id}}">
                            <i class="fa fa-ticket" style="color:#000;font-size: 20px;"></i>
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

const scanner = new Html5QrcodeScanner('reader', {
    // Scanner will be initialized in DOM inside element with id of 'reader'
    qrbox: {
        width: 250,
        height: 250,
    },  // Sets dimensions of scanning box (set relative to reader element width)
    fps: 20, // Frames per second to attempt a scan
});


scanner.render(success, error);
// Starts scanner

function success(result) {

    document.getElementById('result').innerHTML = `
    <input type="number" name="sku" id="sku" value="${result}">
    `;
    // Prints result as a link inside result element

    scanner.clear();
    // Clears scanning instance

    document.getElementById('reader').remove();
    // Removes reader element from DOM since no longer needed

}

function error(err) {
    console.error(err);
    // Prints any errors to the console
}

</script>
@endsection
