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
            <form action="{{ route('productos.buscar') }}" method="POST">
                @csrf
                <input type="text" name="buscar" id="buscar" placeholder="Buscar productos...">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>


    <div class="col-12" style="padding: 0!important;">
        <table id="myTable" class="" style="width:100%">
            <thead>
                <tr class="text-white" style="font-size: 13px;">
                    <th>Nombre</th>
                    <th>Sku</th>
                    <th>Stock</th>
                    <th>Precio</th>
                </tr>
            </thead>
            @foreach ($productos as $producto)
            <tbody class="text-white">
                <tr style="font-size: 13px;">
                    <th class="text-center">{{$producto->name}}</th>
                    <th class="text-center">{{$producto->sku}}</th>
                    <th class="text-center">{{$producto->stock_quantity}}</th>
                    <th class="text-center">${{$producto->price}}.0</th>
                </tr>
            </tbody>
            @endforeach

        </table>

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

    $(document).ready(function () {
    $('#myTable').DataTable();
        responsive: true
    });
</script>
@endsection
