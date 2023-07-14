@extends('layouts.app_admin')

@section('template_title')
   Recibo
@endsection

@section('css')
<style>
    main{
        background: #003249!important;
    }
</style>
@endsection

@section('content')

<section class="p-4" style="min-height: auto;">
    <div class="row">

        <div class="col-6">
            <p class="text-left text-white mt-2" style=""><strong>Datos del cliente:</strong></p>
            <p class="text-left text-white">Josue <br>adrianwebtech@gmail.com <br> 55292291862 <br>{{ $notas->tipo }}</p>

        </div>

        <div class="col-6">

        </div>

        <div class="col-6">
            <p class="text-left text-white mt-2" style=""><strong>Fecha:</strong></p>
            <p class="text-left text-white" style="font-size:12px;">{{ $notas->fecha }}</p>

        </div>

        <div class="col-6"></div>

        @foreach ($notas_productos as $notas_producto)

        <div class="col-6 mt-5">
            <p class="text-left text-white" style=""><strong>Nombre:</strong></p>
            <p class="text-left text-white" style="font-size:12px;">{{ $notas_producto->cantidad }}</p>
        </div>

        <div class="col-3 mt-5">
            <p class="text-left text-white" style=""><strong>Precio:</strong></p>
            <input type="text" class="form-control" value="{{ $notas_producto->precio }}">
        </div>

        <div class="col-3 mt-5">
            <p class="text-left text-white" style=""><strong>Cantidad:</strong></p>
            <input type="number" class="form-control" value="{{ $notas_producto->cantidad }}">
        </div>

        <div class="col-6 mt-2"></div>
        <div class="col-6 mt-2">
            <p class="text-left text-white" style=""><strong>Subtotal:</strong></p>
            <input type="text" class="form-control" value="{{ $notas_producto->subtotal }}">
        </div>

        @endforeach


        <div class="col-6 mt-2">
            <p class="text-left text-white" style=""><strong>Método de pago:</strong></p>
            <select class="form-select" name="" id="">
                <option value="">{{ $notas->metodo_pago }}</option>
            </select>
        </div>

        <div class="col-6 mt-2">
            <p class="text-left text-white" style=""><strong>Comprobante:</strong></p>
        </div>

        <div class="col-6 mt-2">
        </div>

        <div class="col-6 mt-2">
            <p class="text-left text-white" style=""><strong>Total:</strong></p>
            <p class="text-left text-white" style="font-size:12px;">{{ $notas->total }}</p>
        </div>
    </div>
</section>

@endsection
