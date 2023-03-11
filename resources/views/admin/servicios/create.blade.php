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
            <h1 class="text-white text-center">¡Nuevo servicio!</h1>
        </div>

        <div class="col-12" style="padding: 0!important;">
            <div class="d-flex justify-content-center">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="--bs-nav-tabs-border-width: 0px!important;">
                  <button class="nav-link active" id="nav-detalles-tab" data-bs-toggle="tab" data-bs-target="#nav-detalles" type="button" role="tab" aria-controls="nav-detalles" aria-selected="true">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lupa_list.png') }}" alt="">
                    <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Detalles</p>
                  </button>

                  <button class="nav-link" id="nav-Estado-tab" data-bs-toggle="tab" data-bs-target="#nav-Estado" type="button" role="tab" aria-controls="nav-Estado" aria-selected="false">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/evaluacion.png') }}" alt="">
                    <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Estado</p>
                  </button>

                  <button class="nav-link" id="nav-producto-tab" data-bs-toggle="tab" data-bs-target="#nav-producto" type="button" role="tab" aria-controls="nav-producto" aria-selected="false">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/manivela.png') }}" alt="">
                    <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Product</p>
                  </button>

                </div>
              </nav>
            </div>

            <form method="POST" action="{{ route('taller.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-detalles" role="tabpanel" aria-labelledby="nav-detalles-tab" tabindex="0">
                        <div class="row">

                            <h4 class="text-center text-white mt-3">Detalles de la bicicleta</h4>

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Seleciona cliente y/o agrega uno </label>
                                <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text" style="border-radius: 16px 0 0px 0px!important;">
                                        <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/biker.png') }}" alt="">
                                    </span>
                                    <select class="form-control cliente" data-toggle="select" id="id_cliente" name="id_cliente">
                                        <option value="">Seleccionar cliente</option>
                                        @foreach ($cliente as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-secondary btn-sm btn_plus_service" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>

                                    <div class="form-group ">
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body collapse_adduser">
                                                <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre *</label>
                                                        <input  id="nombre" name="nombre" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombre">Telefono *</label>
                                                        <input  id="telefono" name="telefono" type="number" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="nombre">Correo</label>
                                                        <input  id="email" name="email" type="email" class="form-control">
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Fecha </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/calendar-days.png') }}" alt="">
                                </span>

                                <input class="form-control" type="date" value="{{$fechaActual}}" id="fecha" name="fecha">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Marca </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/registrado.png') }}" alt="">
                                </span>

                                <input type="text" class="form-control" id="marca" name="marca" placeholder="Alubike">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Modelo </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/bloque-abc.png') }}" alt="">
                                </span>

                                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="TX100">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Rodada </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/llantas.png') }}" alt="">
                                </span>

                                <input type="number" class="form-control" id="rodada" name="rodada" placeholder="29">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Tipo </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/bicycle.png') }}" alt="">
                                </span>

                                <select class="form-control" id="tipo" name="tipo">
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
                                    <input type="color" class="form-control" id="color" name="color" placeholder="">
                                </span>
                                </div>
                            </div>
                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Color 2</label>
                                <div class=" mb-4">
                                <span class="input-group-text">
                                    <input type="color" class="form-control" id="color_2" name="color_2" placeholder="">
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
                                <input type="file" class="form-control" id="foto1" name="foto1" placeholder="">
                            </div>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">Foto 2 </label>
                                <input type="file" class="form-control" id="foto2" name="foto2" placeholder="">
                            </div>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">Foto 3 </label>
                                <input type="file" class="form-control" id="foto3" name="foto3" placeholder="">
                            </div>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">Foto 4 </label>
                                <input type="file" class="form-control" id="foto4" name="foto4" placeholder="">
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
                                                            <input class="form-check-input" value="1" type="radio" name="cadena" id="cadena">
                                                        </div>
                                                    </td>
                                                    <td><div class="regular">
                                                            <input class="form-check-input" value="2" type="radio" name="cadena" id="cadena">
                                                        </div></td>
                                                    <td><div class="malo">
                                                            <input class="form-check-input" value="3" type="radio" name="cadena" id="cadena">
                                                        </div></td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        Eje
                                                    </th>
                                                    <td><div class="bueno">

                                                            <input class="form-check-input" value="1" type="radio" name="eje" id="eje">

                                                        </div>
                                                    </td>
                                                    <td><div class="regular">

                                                            <input class="form-check-input" value="2" type="radio" name="eje" id="eje">

                                                        </div></td>
                                                    <td><div class="malo">

                                                            <input class="form-check-input" value="3" type="radio" name="eje" id="eje">

                                                        </div></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Mandos
                                                    </th>
                                                    <td><div class="bueno">

                                                            <input class="form-check-input" value="1" type="radio" name="mandos" id="mandos">

                                                        </div>
                                                    </td>
                                                    <td><div class="regular">

                                                            <input class="form-check-input" value="2" type="radio" name="mandos" id="mandos">

                                                        </div></td>
                                                    <td><div class="malo">

                                                            <input class="form-check-input" value="3" type="radio" name="mandos" id="mandos">

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

                                                            <input class="form-check-input" value="1" type="radio" name="frenos_d" id="frenos_d">

                                                        </div>
                                                    </td>
                                                    <td><div class="regular">

                                                            <input class="form-check-input" value="2" type="radio" name="frenos_d" id="frenos_d">

                                                        </div></td>
                                                    <td><div class="malo">

                                                            <input class="form-check-input" value="3" type="radio" name="frenos_d" id="frenos_d">

                                                        </div></td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        Traseros
                                                    </th>
                                                    <td><div class="bueno">

                                                            <input class="form-check-input" value="1" type="radio" name="frenos_t" id="frenos_t">

                                                        </div>
                                                    </td>
                                                    <td><div class="regular">

                                                            <input class="form-check-input" value="2" type="radio" name="frenos_t" id="frenos_t">

                                                        </div></td>
                                                    <td><div class="malo">

                                                            <input class="form-check-input" value="3" type="radio" name="frenos_t" id="frenos_t">

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

                                                            <input class="form-check-input" value="1" type="radio" name="llanta_d" id="llanta_d">

                                                        </div>
                                                    </td>
                                                    <td><div class="regular">

                                                            <input class="form-check-input" value="2" type="radio" name="llanta_d" id="llanta_d">

                                                        </div></td>
                                                    <td><div class="malo">

                                                            <input class="form-check-input" value="3" type="radio" name="llanta_d" id="llanta_d">

                                                        </div></td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        Traseras
                                                    </th>
                                                    <td><div class="bueno">

                                                            <input class="form-check-input" value="1" type="radio" name="llanta_t" id="llanta_t">

                                                        </div>
                                                    </td>
                                                    <td><div class="regular">

                                                            <input class="form-check-input" value="2" type="radio" name="llanta_t" id="llanta_t">

                                                        </div></td>
                                                    <td><div class="malo">

                                                            <input class="form-check-input" value="3" type="radio" name="llanta_t" id="llanta_t">

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

                                                            <input class="form-check-input" value="1" type="radio" name="camara_d" id="camara_d">

                                                        </div>
                                                    </td>
                                                    <td><div class="regular">

                                                            <input class="form-check-input" value="2" type="radio" name="camara_d" id="camara_d">

                                                        </div></td>
                                                    <td><div class="malo">

                                                            <input class="form-check-input" value="3" type="radio" name="camara_d" id="camara_d">

                                                        </div></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Traseras
                                                    </th>
                                                    <td><div class="bueno">

                                                            <input class="form-check-input" value="1" type="radio" name="camara_t" id="camara_t">

                                                        </div>
                                                    </td>
                                                    <td><div class="regular">

                                                            <input class="form-check-input" value="2" type="radio" name="camara_t" id="camara_t">

                                                        </div></td>
                                                    <td><div class="malo">

                                                            <input class="form-check-input" value="3" type="radio" name="camara_t" id="camara_t">

                                                        </div></td>
                                                </tr>
                                        </tbody>
                                    </table>

                                    <label for="">
                                        <p class="text-white"><strong>Observaciones</strong></p>
                                    </label>

                                    <div class="input-group form-group mb-5">
                                        <textarea class="form-control" rows="4" cols="6" value="3" id="observaciones" name="observaciones"></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="nav-producto" role="tabpanel" aria-labelledby="nav-producto-tab" tabindex="0">

                        <h4 class="text-center text-white mt-3">Agregar producto</h4>

                        <div class="col-12 form-group ">
                            <label for="" class="form-control-label label_form_custom">Componentes a cotizar  o conseguir</label>
                            <div class="input-group input-group-alternative mb-4">
                            <textarea name="" id="" cols="35" rows="5"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                    </div>
                </div>
            </form>
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
