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
            <p class="text-left text-white">{{ $customer->first_name.$customer->last_name }} <br> {{ $customer->email  }} <br> {{ $customer->billing->phone}} <br>{{ $notas->tipo }}</p>
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
            <p class="text-left text-white" style="font-size:12px;">{{ $notas_producto->name }}</p>
        </div>

        <div class="col-3 mt-5">
            <p class="text-left text-white" style=""><strong>Precio:</strong></p>
            <input type="text" class="form-control" value="{{ $notas_producto->precio }}" disabled>
        </div>

        <div class="col-3 mt-5">
            <p class="text-left text-white" style=""><strong>Cantidad:</strong></p>
            <input type="number" class="form-control" value="{{ $notas_producto->cantidad }}" disabled>
        </div>

        <div class="col-6 mt-2"></div>
        <div class="col-6 mt-2">
            <p class="text-left text-white" style=""><strong>Subtotal:</strong></p>
            <input type="text" class="form-control" value="{{ $notas_producto->subtotal }}" disabled>
        </div>

        @endforeach

        <div class="col-6 mt-2">
            <p class="text-left text-white" style=""><strong>Método de pago:</strong></p>
            <select class="form-select" name="" id="" disabled>
                <option value="">{{ $notas->metodo_pago }}</option>
            </select>
        </div>

        <div class="col-6 mt-2">
            <p class="text-left text-white" style=""><strong>Total:</strong></p>
            <p class="text-left text-white" style="font-size:12px;">{{ $notas->total }}</p>
        </div>

        <div class="col-6 mt-5">
            <a href="https://api.whatsapp.com/send?phone=+52 {{ $customer->billing->phone}}&text=Hola,%20este%20es%20mi%20pedido.%20¿Podrían%20ayudarme%20con%20esto?%0A%0A{{ url()->current() }}" target="_blank" class="btn btn-success">Enviar mensaje de WhatsApp</a>
        </div>


    </div>
</section>

@endsection
