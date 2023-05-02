@extends('layouts.app_admin')

@section('template_title')
   Servicios
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/servicios_index.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
@endsection

@section('content')
<section class="" style="min-height: 700px;padding: 15px;">

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between mb-2">
            <h2 class="text-left text-white mt-3">Servicios</h2>
                <input type="text" name="buscar" id="buscar" placeholder="Buscar productos...">
                <button type="submit" class="btn close-modal"  id="btn-buscar" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Buscar</button>
            </div>
    </div>


    <div class="col-12" style="padding: 0!important;">
        <div id="resultados"></div>
    </div>

</div>

</section>
@include('admin.productos.modal_create_product')

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

    $(document).ready(function() {
        $('#btn-buscar').click(function() {
            buscar();
        });
    });

    function buscar() {
        var buscar = $('#buscar').val();
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('productos.buscar') }}',
            type: 'POST',
            data: {
                'buscar': buscar,
                '_token': token // Agregar el token CSRF a los datos enviados
            },
            success: function(response) {
                $('#resultados').html(response);
            }
        });
    }

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>
@endsection
