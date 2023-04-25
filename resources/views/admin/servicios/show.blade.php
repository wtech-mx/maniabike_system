@extends('layouts.app_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/servicios.css')}}">
<style>
    main{
        background: #003249!important;
    }
</style>
@endsection

@section('content')

<section class="servicios" style="min-height: 900px;">

    <div class="row">

        <div class="col-12 mt-3 mb-3">
            @if ($servicio->estatus == 1 )
            <div class="d-flex justify-content-center">
                <div class="form-check mt-3">
                    <label style="color: #ffff" class="form-check-label content_label_estatus" >
                        En Proceso<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="" style="height: 60px;">
                    </label>
                    <input class="form-check-input" type="radio" name="estatus" value="1" id="estatus" checked>
                </div>
            </div>
            @elseif ($servicio->estatus == 2)
            <div class="d-flex justify-content-center">
                <div class="form-check mt-3 mb-3">
                    <label style="color: #ffff" class="form-check-label content_label_estatus" >
                        En Espera<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="" style="height: 60px;">
                    </label>
                    <input class="form-check-input" type="radio" name="estatus" value="2" id="estatus">
                </div>
            </div>
            @elseif ($servicio->estatus == 3)
            <div class="d-flex justify-content-center">
                <div class="form-check mt-3 ">
                    <label style="color: #ffff" class="form-check-label content_label_estatus" >
                        Realizado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/comprobado.png') }}" alt="" style="height: 60px;">
                    </label>
                    <input class="form-check-input" type="radio" name="estatus" value="3" id="estatus" checked>
                </div>
            </div>
            @elseif ($servicio->estatus == 4)
            <div class="d-flex justify-content-center">
                <div class="form-check mt-3">
                    <label style="color: #ffff" class="form-check-label content_label_estatus" >
                        Candelado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="" style="height: 60px;">
                    </label>
                    <input class="form-check-input" type="radio" name="estatus" value="4" id="estatus">
                </div>
            </div>
            @elseif ($servicio->estatus == 0)
            <div class="d-flex justify-content-center">
                <div class="form-check mt-3 mb-3">
                    <label style="color: #ffff" class="form-check-label content_label_estatus" >
                        Ingresado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="" style="height: 60px;">
                    </label>
                    <input class="form-check-input" type="radio" name="estatus" value="0" id="estatus" >
                </div>
            </div>
            @elseif ($servicio->estatus == 5)
            <div class="d-flex justify-content-center">
                <div class="form-check mt-3 mb-3">
                    <label style="color: #ffff" class="form-check-label content_label_estatus" >
                        Pagado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="" style="height: 60px;">
                    </label>
                    <input class="form-check-input" type="radio" name="estatus" value="5" id="estatus" >
                </div>
            </div>
            @endif
        </div>

        <div class="col-12">
            <form method="POST" action="{{ route('taller.update', $servicio->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-detalles" role="tabpanel" aria-labelledby="nav-detalles-tab" tabindex="0">
                        <div class="row">

                            <h4 class="text-center text-white mt-3">Detalles de la bicicleta</h4>

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Seleciona cliente y/o agrega uno </label>
                                <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text">
                                        <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/biker.png') }}" alt="">
                                    </span>
                                    <select class="form-control cliente" data-toggle="select" id="id_cliente" name="id_cliente" disabled>
                                        <option value="{{$servicio->id_cliente}}">{{$servicio->Cliente->nombre}}</option>
                                        @foreach ($cliente as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Fecha </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/calendar-days.png') }}" alt="">
                                </span>

                                <input class="form-control" type="date" value="{{$servicio->fecha}}" disabled>
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Marca </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/registrado.png') }}" alt="">
                                </span>

                                <input type="text" class="form-control" id="marca" name="marca" value="{{$servicio->marca}}" disabled>
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Modelo </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/bloque-abc.png') }}" alt="">
                                </span>

                                <input type="text" class="form-control" id="modelo" name="modelo" value="{{$servicio->modelo}}" disabled>
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Rodada </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/llantas.png') }}" alt="">
                                </span>

                                <input type="number" class="form-control" id="rodada" name="rodada" value="{{$servicio->rodada}}" disabled>
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Tipo </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/bicycle.png') }}" alt="">
                                </span>

                                <select class="form-control" id="tipo" name="tipo" disabled>
                                    <option value="{{$servicio->tipo}}">{{$servicio->tipo}}</option>
                                    <option value="BMX">BMX</option>
                                    <option value="Ciudad">Ciudad</option>
                                    <option value="Carrera">Carrera</option>
                                    <option value="Electrica">Electrica</option>
                                    <option value="MTB(Monrtain Bike)">MTB(Monrtain Bike)</option>
                                    <option value="Niño">Niño</option>
                                </select>
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Color </label>
                                <div class=" mb-4">
                                <span class="input-group-text">
                                    <input type="color" class="form-control" id="color" name="color" value="{{$servicio->color}}" disabled>
                                </span>
                                </div>
                            </div>
                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Color 2</label>
                                <div class=" mb-4">
                                <span class="input-group-text">
                                    <input type="color" class="form-control" id="color_2" name="color_2" value="{{$servicio->color_2}}" disabled>
                                </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-Estado" role="tabpanel" aria-labelledby="nav-Estado-tab" tabindex="0">

                        <div class="row">

                            <h4 class="text-center text-white mt-3">Estado de la bicicleta</h4>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">Foto 1 </label>
                                <img src="{{asset('fotos_bicis/'.$servicio->foto1)}}" style="width: 100px; border-radius: 19px; margin-top: 1rem;">
                            </div>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">Foto 2 </label>
                                <img src="{{asset('fotos_bicis/'.$servicio->foto2)}}" style="width: 100px; border-radius: 19px; margin-top: 1rem;">
                            </div>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">Foto 3 </label>
                                <img src="{{asset('fotos_bicis/'.$servicio->foto3)}}" style="width: 100px; border-radius: 19px; margin-top: 1rem;">
                            </div>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">Foto 4 </label>
                                <img src="{{asset('fotos_bicis/'.$servicio->foto4)}}" style="width: 100px; border-radius: 19px; margin-top: 1rem;">
                            </div>

                            <div class="col-12 mt-3">

                                <div  id="canvasDiv">

                                    <table id="seguro" class="table text-white">
                                        <thead>
                                            <tr>
                                                <th scope="col">Revisión de:</th>
                                                <th scope="col">Bueno</th>
                                                <th scope="col">Regular</th>
                                                <th scope="col">Malo</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="color: #80CED7">
                                                <th>
                                                    Transmicion
                                                </th>
                                            </tr>

                                                <tr>
                                                    <th>
                                                        Cadena
                                                    </th>
                                                    <td>
                                                        <div class="bueno">
                                                            @if ($servicio->cadena == 1)
                                                                <input class="form-check-input" value="1" type="radio" name="cadena" id="cadena" checked disabled>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                            @if ($servicio->cadena == 2)
                                                                <input class="form-check-input" value="2" type="radio" name="cadena" id="cadena" checked disabled>
                                                            @endif
                                                        </div></td>
                                                    <td><div class="malo">
                                                            @if ($servicio->cadena == 3)
                                                                <input class="form-check-input" value="3" type="radio" name="cadena" id="cadena" checked disabled>
                                                            @endif
                                                        </div></td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        Eje
                                                    </th>
                                                    <td><div class="bueno">
                                                            @if ($servicio->eje == 1)
                                                                <input class="form-check-input" value="1" type="radio" name="eje" id="eje" checked disabled>

                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                            @if ($servicio->eje == 2)
                                                                <input class="form-check-input" value="2" type="radio" name="eje" id="eje" checked disabled>

                                                            @endif
                                                        </div></td>
                                                    <td><div class="malo">
                                                            @if ($servicio->eje == 3)
                                                                <input class="form-check-input" value="3" type="radio" name="eje" id="eje" checked disabled>

                                                            @endif
                                                        </div></td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        Mandos
                                                    </th>
                                                    <td><div class="bueno">
                                                            @if ($servicio->mandos == 1)
                                                                <input class="form-check-input" value="1" type="radio" name="mandos" id="mandos" checked disabled>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                            @if ($servicio->mandos == 2)
                                                                <input class="form-check-input" value="2" type="radio" name="mandos" id="mandos" checked disabled>

                                                            @endif
                                                        </div></td>
                                                    <td><div class="malo">
                                                            @if ($servicio->mandos == 3)
                                                                <input class="form-check-input" value="3" type="radio" name="mandos" id="mandos" checked disabled>

                                                            @endif

                                                        </div></td>
                                                </tr>

                                                <tr style="color: #80CED7">
                                                    <th>
                                                        Frenos (Zapata y/o Balata)
                                                    </th>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        Delanteros
                                                    </th>
                                                    <td><div class="bueno">
                                                            @if ($servicio->frenos_d == 1)
                                                                <input class="form-check-input" value="1" type="radio" name="frenos_d" id="frenos_d" checked disabled>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                            @if ($servicio->frenos_d == 2)
                                                                <input class="form-check-input" value="2" type="radio" name="frenos_d" id="frenos_d" checked disabled>
                                                            @endif
                                                        </div></td>
                                                    <td><div class="malo">
                                                            @if ($servicio->frenos_d == 3)
                                                                <input class="form-check-input" value="3" type="radio" name="frenos_d" id="frenos_d" checked disabled>

                                                            @endif
                                                        </div></td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        Traseros
                                                    </th>
                                                    <td><div class="bueno">
                                                            @if ($servicio->frenos_t == 1)
                                                                <input class="form-check-input" value="1" type="radio" name="frenos_t" id="frenos_t" checked disabled>

                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                            @if ($servicio->frenos_t == 2)
                                                                <input class="form-check-input" value="2" type="radio" name="frenos_t" id="frenos_t" checked disabled>
                                                            @endif
                                                        </div></td>
                                                    <td><div class="malo">
                                                            @if ($servicio->frenos_t == 3)
                                                                <input class="form-check-input" value="3" type="radio" name="frenos_t" id="frenos_t" checked disabled>
                                                            @endif
                                                        </div></td>
                                                </tr>

                                                <tr style="color: #80CED7">
                                                    <th>
                                                        Llantas
                                                    </th>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        Delanteras
                                                    </th>
                                                    <td><div class="bueno">
                                                            @if ($servicio->llanta_d == 1)
                                                                <input class="form-check-input" value="1" type="radio" name="llanta_d" id="llanta_d" checked disabled>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                        @if ($servicio->llanta_d == 2)
                                                            <input class="form-check-input" value="2" type="radio" name="llanta_d" id="llanta_d" checked disabled>
                                                        @endif
                                                        </div></td>
                                                    <td><div class="malo">
                                                        @if ($servicio->llanta_d == 3)
                                                            <input class="form-check-input" value="3" type="radio" name="llanta_d" id="llanta_d" checked disabled>
                                                        @endif
                                                        </div></td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        Traseras
                                                    </th>
                                                    <td><div class="bueno">
                                                        @if ($servicio->llanta_t == 1)
                                                            <input class="form-check-input" value="1" type="radio" name="llanta_t" id="llanta_t" checked disabled>
                                                        @endif
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                        @if ($servicio->llanta_t == 2)
                                                            <input class="form-check-input" value="2" type="radio" name="llanta_t" id="llanta_t" checked disabled>
                                                        @endif
                                                        </div></td>
                                                    <td><div class="malo">
                                                        @if ($servicio->llanta_t == 3)
                                                            <input class="form-check-input" value="3" type="radio" name="llanta_t" id="llanta_t">
                                                        @endif
                                                        </div></td>
                                                </tr>
                                                <tr style="color: #80CED7">
                                                    <th>
                                                        Camaras
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Delantera
                                                    </th>
                                                    <td><div class="bueno">
                                                        @if ($servicio->camara_d == 1)
                                                            <input class="form-check-input" value="1" type="radio" name="camara_d" id="camara_d" checked disabled>
                                                        @endif
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                        @if ($servicio->camara_d == 2)
                                                            <input class="form-check-input" value="2" type="radio" name="camara_d" id="camara_d" checked disabled>
                                                        @endif
                                                        </div></td>
                                                    <td><div class="malo">
                                                        @if ($servicio->camara_d == 3)
                                                            <input class="form-check-input" value="3" type="radio" name="camara_d" id="camara_d" checked disabled>

                                                        @endif
                                                        </div></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Trasera
                                                    </th>
                                                    <td><div class="bueno">
                                                        @if ($servicio->camara_t == 1)
                                                            <input class="form-check-input" value="1" type="radio" name="camara_t" id="camara_t" checked disabled>
                                                        @endif
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                        @if ($servicio->camara_t == 2)
                                                            <input class="form-check-input" value="2" type="radio" name="camara_t" id="camara_t" checked disabled>
                                                        @endif
                                                        </div></td>
                                                    <td><div class="malo">
                                                        @if ($servicio->camara_t == 3)
                                                            <input class="form-check-input" value="3" type="radio" name="camara_t" id="camara_t" checked disabled>
                                                        @endif
                                                        </div></td>
                                                </tr>

                                        </tbody>
                                    </table>

                                    <label for="">
                                        <p class="text-white"><strong>Observaciones</strong></p>
                                    </label>

                                    <div class="input-group form-group mb-5 text-white">
                                        {{$servicio->observaciones}}
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                    </div> --}}
                </div>
            </form>
            <div class="d-flex justify-content-center">
                <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="--bs-nav-tabs-border-width: 0px!important;">
                  <button class="nav-link active" id="nav-detalles-tab" data-bs-toggle="tab" data-bs-target="#nav-detalles" type="button" role="tab" aria-controls="nav-detalles" aria-selected="true">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lupa_list.png') }}" alt="">
                    <p class="text-center d-inline-block mt-3">Detalles</p>
                  </button>

                  <button class="nav-link" id="nav-Estado-tab" data-bs-toggle="tab" data-bs-target="#nav-Estado" type="button" role="tab" aria-controls="nav-Estado" aria-selected="false">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/evaluacion.png') }}" alt="">
                    <p class="text-center d-inline-block mt-3">Estado</p>
                  </button>

                  <button class="nav-link" id="nav-producto-tab" data-bs-toggle="tab" data-bs-target="#nav-producto" type="button" role="tab" aria-controls="nav-producto" aria-selected="false">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/manivela.png') }}" alt="">
                    <p class="text-center d-inline-block mt-3">Producto</p>
                  </button>

                </div>
              </nav>
            </div>
        </div>

    </div>

</section>

@endsection

@section('select2')

  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script type="text/javascript">
            $(document).ready(function() {
                $('.cliente').select2();
            });
    </script>

@endsection
