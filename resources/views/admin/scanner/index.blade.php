@extends('layouts.app_admin')

@section('template_title')
   Crear Servicio
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/servicios.css')}}">
<style>
    main{
        background: #003249!important;
    }
    .table td, .table th {
    white-space: revert!important;
    }

    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 0px solid transparent !important;
    border-radius: 0px!important;
    padding: 22px;
}

.select2 {
    width: 380px!important;
}

</style>
@endsection

@section('content')

<section class="servicios" style="min-height:auto;padding: 20px;">

    <div class="row">

        <div class="col-12 mt-3 mb-3">
            <h1 class="text-white text-center">¡Scanner!</h1>


        <div class="col-12" style="padding: 0!important;">


            <div class="d-flex justify-content-center mt-5">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="--bs-nav-tabs-border-width: 0px!important;">
                      <button class="nav-link active" id="nav-detalles-tab" data-bs-toggle="tab" data-bs-target="#nav-detalles" type="button" role="tab" aria-controls="nav-detalles" aria-selected="true">
                        <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lupa_list.png') }}" alt="">
                        <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Servicio</p>
                      </button>

                      <button class="nav-link" id="nav-producto-tab" data-bs-toggle="tab" data-bs-target="#nav-producto" type="button" role="tab" aria-controls="nav-producto" aria-selected="false">
                        <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/manivela.png') }}" alt="">
                        <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Productos</p>
                      </button>

                    </div>
                  </nav>
                </div>
            </div>

        <div class="col 12">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-detalles" role="tabpanel" aria-labelledby="nav-detalles-tab" tabindex="0">
                    Servicios
                </div>

                <div class="tab-pane fade show active" id="nav-producto" role="tabpanel" aria-labelledby="nav-producto-tab" tabindex="0">
                    Servicios
                </div>
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
