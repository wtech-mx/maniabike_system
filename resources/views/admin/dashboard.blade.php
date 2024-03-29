@extends('layouts.app_admin')

@section('content')

<section class="dashboard" style="background: {{$configuracion->color_principal}}!important;min-height: 800px;">
    <div class="row">


        <div class="col-12 mt-5">
            <h1 class="text-white">¡Hola! {{ Auth::user()->name }} </h1>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <p class="text-white">Cerrar Sesión</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <div class="row">
            @can('servicios-list')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-7">
                            <a href="{{ route('taller.index') }}">
                                <div class="btn_bg_primario" style="background: {{$configuracion->color_boton_close}}!important">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/engranaje.png') }}" alt="">
                                    <p class="text-white d-inline-block">Servicios</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-2">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('scanner.index') }}">
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/qr-code.png') }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('taller.create') }}">
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan


            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-9">
                        <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                            @can('client-list')
                                <a href="{{ route('clients.index') }}">
                                @else
                                <a>
                            @endcan
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/biker.png') }}" alt="">
                                    <p class="text-white d-inline-block">Clientes</p>
                                </a>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                                @can('client-create')
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modal_creat_user">
                                    @else
                                    <a>
                                @endcan
                                <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                    <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-9">
                        <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                            @can('productos-list')
                                <a href="{{route('scanner_products.index')}}">
                                    @else
                                <a>
                            @endcan
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/manivela.png') }}" alt="">
                                    <p class="text-white d-inline-block">Productos</p>
                                </a>

                        </div>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                            @can('productos-create')
                                <a href="" data-bs-toggle="modal" data-bs-target="#modal_creat_product">
                                    @else
                                <a>
                            @endcan
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                                    </div>
                                </a>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-9">
                        @can('recordatorios-list')
                                <a href="{{ route('recordatorios.index') }}">
                            @else
                                <a>
                        @endcan
                        <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                            <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/recordatorio.png') }}" alt="">
                            <p class="text-white d-inline-block">Recordatorio</p>
                        </div>
                        </a>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                            @can('recordatorios-create')
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#recordatorio">
                                @else
                                    <a>
                            @endcan
                                <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                    <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @can('reportes')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/pie-chart.png') }}" alt="">
                                <p class="text-white d-inline-block">Reportes</p>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('scanner.index') }}">
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/barcode.png') }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('usuarios-list')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="/users">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                                    <p class="text-white d-inline-block">Usuarios</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('users.create') }}">
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-9">
                        <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                            @can('caja')
                            <a href="{{ route('index.caja') }}">
                                @else
                            </a>
                            @endcan
                                <a href="{{ route('index.caja') }}">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/point-of-sale.png') }}" alt="">
                                    <p class="text-white d-inline-block">Caja</p>
                                </a>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                            @can('ordenes')
                                <a href="{{ route('ordenes.index') }}">
                                    @else
                                <a>
                            @endcan
                            <a href="{{ route('ordenes.index') }}">
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/papel.png') }}" alt="">
                                    </div>
                                </a>
                        </div>
                    </div>
                </div>
            </div>

            @can('inventario')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('inventario.index') }}">
                                <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/inventario.png') }}" alt="">
                                    <p class="text-white d-inline-block">Inventario</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-12">
                        <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                            <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/llantas.png') }}" alt="">
                            <p class="text-white d-inline-block">Pedidos Taller</p>
                        </div>
                    </div>
                </div>
            </div>

            @can('configuracion')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="{{ route('index.configuracion') }}">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/reparar.png') }}" alt="">
                                    <p class="text-white d-inline-block">Configuración</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('role-list')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="{{ route('roles.index') }}">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/papel.png') }}" alt="">
                                    <p class="text-white d-inline-block">Roles y Permisos</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan


        </div>

    </div>
</section>
@include('admin.productos.modal_create_product')
@can('recordatorios-create')
    @include('admin.recordatorios.modal_create')
@endcan
@include('admin.cliente.create')
@endsection
