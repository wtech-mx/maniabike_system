@extends('layouts.app_admin')

@section('content')

<section class="dashboard" style="min-height: 800px;">
    <div class="row">


        <div class="col-12 mt-5">
            <h1 class="text-white">¡Hola! Pablo </h1>
        </div>

        <div class="row">

            <div class="col-12 col-md-6 py-3">
                <div class="row">

                    <div class="col-9">
                        <a href="{{ route('taller.index') }}">
                            <div class="btn_bg_primario">
                                <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/engranaje.png') }}" alt="">
                                <p class="text-white d-inline-block">Servicios</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('taller.create') }}">
                                <div class="btn_border_primario">
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
                        <div class="btn_bg_primario">
                            <a href="{{ route('clients.index') }}">
                                <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/biker.png') }}" alt="">
                                <p class="text-white d-inline-block">Usuarios</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_creat_user">
                                <div class="btn_border_primario">
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
                        <div class="btn_bg_primario">
                            <a href="{{route('scanner_products.index')}}">
                                <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/manivela.png') }}" alt="">
                                <p class="text-white d-inline-block">Productos</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_creat_product">
                                <div class="btn_border_primario">
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
                        <div class="btn_bg_primario">
                            <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/recordatorio.png') }}" alt="">
                            <p class="text-white d-inline-block">Recordatorio</p>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                            <div class="btn_border_primario">
                                <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-9">
                        <div class="btn_bg_primario">
                            <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/pie-chart.png') }}" alt="">
                            <p class="text-white d-inline-block">Reportes</p>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('scanner.index') }}">
                                <div class="btn_border_primario">
                                    <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/barcode.png') }}" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-12">
                        <div class="btn_bg_primario">
                            <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/bicycle.png') }}" alt="">
                            <p class="text-white d-inline-block">Bicicletas</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-12">
                        <div class="btn_bg_primario">
                            <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/llantas.png') }}" alt="">
                            <p class="text-white d-inline-block">Pedidos Taller</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
@include('admin.productos.modal_create_product')
@include('admin.cliente.create')
@endsection
