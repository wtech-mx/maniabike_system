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

  @yield('css')

  <link rel="stylesheet" href="{{ asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css')}}">

  <link id="pagestyle" href="{{ asset('assets/admin/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body>

<main class="container-fluid" style="background: #007EA7;">

    @yield('content')

</main>

  <script src="{{ asset('assets/admin/js/core/popper.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/datatables.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/fullcalendar.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/jkanban/jkanban.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/chartjs.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/argon-dashboard.min.js')}}"></script>

  @yield('js_custom')

  @yield('datatable')

  @yield('fullcalendar')

  @yield('select2')

  @livewireScripts
</body>

</html>
