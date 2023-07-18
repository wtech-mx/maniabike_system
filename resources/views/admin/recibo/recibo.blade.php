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
            @if ($customer->billing->phone = " ")
            <p class="text-white text-left">No se encontro numero telefonico</p>
            <form id="whatsappForm">
                <label for="phoneInput" class="text-white">Ingresar Numero:</label>
                <input class="form-control" type="text" id="phoneInput"  placeholder="55-55-55-55-55" required>
                <button type="submit" class="btn btn-success mt-3" style="width: 100%;">Enviar WhatsApp</button>
            </form>
            @else
            <a href="https://api.whatsapp.com/send?phone=+52 {{ $customer->billing->phone}}&text=Hola,%20este%20es%20mi%20pedido.%20¿Podrían%20ayudarme%20con%20esto?%0A%0A{{ url()->current() }}" target="_blank" class="btn btn-success">Enviar WhatsApp</a>
            @endif
        </div>


    </div>
</section>

<script>
    // Obtener el formulario y el campo de teléfono
    const form = document.getElementById('whatsappForm');
    const phoneInput = document.getElementById('phoneInput');

    // Manejar el evento de envío del formulario
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío del formulario

        const phoneNumber = phoneInput.value;

        // Verificar que se haya ingresado un número de teléfono
        if (phoneNumber.trim() === '') {
            alert('Por favor, ingresa un número de teléfono válido.');
            return;
        }

        // Mensaje personalizado
        const message = `Gracias por tu visita a Maniabike.\nPuedes ver el resumen de tu pedido en el siguiente enlace:\n\n ${window.location.href}`;

        // Obtener el enlace de WhatsApp con el número de teléfono y el mensaje
        const whatsappLink = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;

        // Abrir el enlace de WhatsApp en una nueva pestaña
        window.open(whatsappLink, '_blank');
    });
</script>

@endsection

