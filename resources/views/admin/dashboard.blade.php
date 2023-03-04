@extends('layouts.app_admin')

@section('content')

<section class="dashboard">
    <div class="row">

        <div class="col-12">
            <h1>¡Hola! Pablo </h1>
        </div>

        <div class="row">

            <div class="col-12 col-md-6">
                <div class="row">

                    <div class="col-10">
                        <div class="btn_bg_primario">
                            <a class="btn btn_border_primario d-flex align-items-center">
                                <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/engranaje.png') }}" alt="">
                                <p class="text-center">Servicios</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-2">
                        <a class="btn btn-primary d-flex">
                            +
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="row">

                    <div class="col-10">
                        <a class="btn btn-primary d-flex">
                            Servicios
                        </a>
                    </div>

                    <div class="col-2">
                        <a class="btn btn-primary d-flex">
                            +
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
