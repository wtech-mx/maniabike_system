<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
 <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}">
  <link rel="icon" type="image/png" href="{{ asset('favicon/'. $configuracion->favicon) }}">
  <title>
    @yield('template_title') - {{$configuracion->nombre_sistema}}
  </title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />


  <link href="{{ asset('assets/admin/css/nucleo-svg.css')}}" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <link href="{{ asset('assets/admin/css/nucleo-svg.css')}}" rel="stylesheet" />



  <link rel="stylesheet" href="{{ asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/preloader.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/footer.css')}}">

  @yield('css')

  <link id="pagestyle" href="{{ asset('assets/admin/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<style>
    .preloader {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7);
    text-align: center;
    padding-top: 30%;
    font-size: 1.5em;
    z-index: 9999;
}

</style>

<main class="container-fluid" style="background: {{$configuracion->color_principal}};padding: 0!important;">

    <div id="page-loader"><span class="preloader-interior"></span></div>

    @yield('content')

    <footer class="footer footer_custom_fixed mt-auto" style="background: {{$configuracion->color_iconos_cards}}!important">
        <div class="row">
            <div class="col-4">
                <p class="text-center">
                    <a class="btn_back" onclick="history.back()" style="color: {{$configuracion->color_iconos_sidebar}}!important; border-color: {{$configuracion->color_iconos_sidebar}}!important">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </p>
            </div>

            <div class="col-4">
                <a href="{{ route('dashboard') }}" >
                    <p class="text_custom_navbar text-center" style="color: {{$configuracion->color_iconos_sidebar}}!important">Inicio</p>
                </a>
            </div>

            <div class="col-4" style="padding: 0;">
                @yield('columna_4')
            </div>
        </div>
    </footer>

</main>




  <script src="{{ asset('assets/admin/js/core/popper.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/core/bootstrap.min.js')}}"></script>
  {{-- <script src="{{ asset('assets/admin/js/plugins/datatables.js')}}"></script> --}}
  <script src="{{ asset('assets/admin/js/plugins/fullcalendar.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/chartjs.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/argon-dashboard.min.js')}}"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="{{ asset('assets/admin/js/preloader.js')}}"></script>

  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

  @yield('js_custom')

  @yield('datatable')

  @yield('fullcalendar')

  @yield('select2')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("miFormulario");
        const preloader = document.getElementById("page-loader");
        const submitBtn = document.getElementById("submitBtn");

        form.addEventListener("submit", function () {
            preloader.style.display = "block";
            submitBtn.disabled = true; // Deshabilita el botón mientras se procesa el formulario
        });
    });

    </script>
</body>

</html>
