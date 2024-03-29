@extends('layouts.app_admin')

@section('template_title')
    Ordenes
@endsection

@section('css')
    @php
        use Carbon\Carbon;
    @endphp

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
<section class="" style="min-height: 800px;padding: 15px;">

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <h2 class="text-left text-white mt-3">Ordenes</h2>
                <a href="{{ route('index.caja') }}" style="background-color: #fff;bnota-radius:13px;padding:5px;">
                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/point-of-sale.png') }}" alt="">
                </a>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-deudores-tab" data-bs-toggle="pill" data-bs-target="#pills-deudores" type="button" role="tab" aria-controls="pills-deudores" aria-selected="true">Deudores</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-ordenes-tab" data-bs-toggle="pill" data-bs-target="#pills-ordenes" type="button" role="tab" aria-controls="pills-ordenes" aria-selected="false">Ordenes</button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-deudores" role="tabpanel" aria-labelledby="pills-deudores-tab">
                <h4 class="text-left text-white mt-3">Deudores</h4>
                <div class="col-12" style="padding: 0!important;">
                    @can('client-list')
                        <table class="responsive" id="myTable" class="" style="width:100%">
                            <thead class="thead  text-white">
                                <tr>
                                    <th class="text-white" style="font-size: 10px;">Id</th>
                                    <th class="text-white" style="font-size: 10px;">Saldo F.</th>
                                    <th class="text-white" style="font-size: 10px;">Restante</th>
                                    <th class="text-white" style="font-size: 10px;">Total</th>
                                    <th class="text-white" style="font-size: 10px;">Fecha</th>
                                    @can('personal')
                                    <th class="text-white" style="font-size: 10px;">Usuario</th>
                                    @endcan
                                    <th class="text-white" style="font-size: 10px;">Acciones</th>
                                </tr>
                            </thead>|
                            <tbody>
                                @foreach ($notas_deudores as $nota)
                                @php
                                    $fecha = $nota->fecha;
                                    $fechaFormateada = Carbon::parse($fecha)->format('d/m/y');
                                @endphp
                                        <td class="text-white" style="font-size: 10px;">{{$nota->id}}</td>
                                        <td class="text-white" style="font-size: 10px;">${{$nota->saldo_favor}}</td>
                                        <td class="text-white" style="font-size: 10px;">${{$nota->restante}}</td>
                                        <td class="text-white" style="font-size: 10px;">${{$nota->total}}</td>
                                        <td class="text-white" style="font-size: 10px;">{{$fechaFormateada}}</td>
                                        @can('personal')
                                            @if ($nota->id_user == 0)
                                                <td class="text-white" style="font-size: 10px;">Sin user</td>
                                            @else
                                                <td class="text-white" style="font-size: 10px;">{{ $nota->Usuario->name }}</td>
                                            @endif
                                        @endcan

                                        <td class="text-white" style="font-size: 10px;">
                                            <a href="" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#modal_estatus{{$nota->id}}">
                                                <i class="fa fa-exchange"></i>
                                            </a>
                                            <a href="{{ route('notas.edit', $nota->id) }}" target="_blank" class="btn btn-success btn-xs">
                                                <i class="fa fa-send"></i>
                                            </a>
                                            <a href="{{ route('imprimir.recibo', $nota->id) }}" class="btn btn-primary btn-xs">
                                                <i class="fa fa-print"></i>
                                            </a>
                                             {{-- <button class="imprimirButton"  class="btn btn-success btn-xs" data-id="{{ $nota->id }}"><i class="fa fa-print"></i>2</button> --}}

                                        </td>
                                    </tr>
                                    @include('admin.caja.modal_estatus')
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h2 class="text-center text-white mt-3">No tienes Permiso Para ver esta vista.</h2>
                    @endcan
                </div>
            </div>

            <div class="tab-pane fade" id="pills-ordenes" role="tabpanel" aria-labelledby="pills-ordenes-tab">
                <h4 class="text-left text-white mt-3">Ordenes</h4>
                <div class="col-12" style="padding: 0!important;">
                    @can('client-list')
                        <table class="responsive" id="myTable2" class="" style="width:100%">
                            <thead class="thead  text-white">
                                <tr>
                                    <th class="text-white" style="font-size: 10px;">Id</th>
                                    <th class="text-white" style="font-size: 10px;">Met. Pago</th>
                                    <th class="text-white" style="font-size: 10px;">Total</th>
                                    <th class="text-white" style="font-size: 10px;">Fecha</th>
                                    <th class="text-white" style="font-size: 10px;">Tipo</th>
                                    @can('personal')
                                    <th class="text-white" style="font-size: 10px;">Usuario</th>
                                    @endcan
                                    <th class="text-white" style="font-size: 10px;">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notas as $nota)
                                        <td class="text-white" style="font-size: 10px;">{{$nota->id}}</td>
                                        <td class="text-white" style="font-size: 10px;">{{$nota->metodo_pago}}</td>
                                        <td class="text-white" style="font-size: 10px;">{{$nota->total}}</td>
                                        @php
                                            $fecha = $nota->fecha;
                                            $fechaFormateada = Carbon::parse($fecha)->format('d/m/y');
                                        @endphp
                                        <td class="text-white" style="font-size: 10px;">{{$fechaFormateada}}</td>
                                        <td class="text-white" style="font-size: 10px;">{{$nota->tipo}}</td>
                                        @can('personal')
                                            @if ($nota->id_user == 0)
                                                <td class="text-white" style="font-size: 10px;">Sin user</td>
                                            @else
                                                <td class="text-white" style="font-size: 10px;">{{ $nota->Usuario->name }}</td>
                                            @endif
                                        @endcan
                                        <td class="text-white" style="font-size: 10px;">
                                            <a href="" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#modal_estatus{{$nota->id}}">
                                                <i class="fa fa-exchange"></i>
                                            </a>
                                            <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-success btn-xs">
                                                <i class="fa fa-send"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @include('admin.caja.modal_estatus')
                                @endforeach

                            </tbody>
                        </table>
                        @else
                        <h2 class="text-center text-white mt-3">No tienes Permiso Para ver esta vista.</h2>
                    @endcan
                </div>
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
<script src="{{ asset('assets/admin/js/ConectorJavaScript.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                responsive: true,
                order: [[0, 'desc']]
            });
        });

        $(document).ready(function () {
            $('#myTable2').DataTable({
                responsive: true,
                order: [[0, 'desc']]
            });
        });


            // Agrega un evento de clic a todos los botones con la clase "imprimirButton"
// Agrega un evento de clic a todos los botones con la clase "imprimirButton"
$('.imprimirButton').click(async function() { // Agrega "async" aquí
    console.log('click');
    // Obtén el ID de la nota desde el atributo "data-id"
    const id = $(this).data('id');
    const url = '/imprimir-recibo2/' + id;

    // Realiza la solicitud AJAX
    $.ajax({
        url: url,
        type: 'get',
        data: {
            '_token': '{{ csrf_token() }}', // Agregar el token CSRF a los datos enviados
        },
        success: async function(response) { // Agrega "async" aquí
            console.log('Data from AJAX buscador:', response);

            // Obtén los datos del recibo de la respuesta AJAX
            const recibo = response.recibo;
            console.log('conector', recibo);

            // Empezar a usar el plugin
            const conector = new ConectorPluginV3();
            console.log('conector', conector);

            conector
                .EscribirTexto("Ticket de venta\n")
                .EscribirTexto("Fecha: " + recibo.fecha)
                .Feed(1);
            for (const producto of recibo.productos) {
                conector.EscribirTexto(producto.nombre + " precio: " + producto.precio);
                conector.Feed(1);
            }

            const respuesta = await conector.imprimirEn(recibo.nombreImpresora);
            if (!respuesta) {
                alert("Error al imprimir ticket: " + respuesta);
            } else {
                alert("Impresion realziada ");
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});



</script>

@endsection

