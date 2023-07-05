@extends('layouts.app_admin')

@section('template_title')
    Caja
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/servicios.css')}}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/scanner.css')}}">
<style>
    .producto-escaneado{
        background: #80CED7;
    }
</style>
@endsection

@section('content')

<section class="servicios" style="min-height:auto;padding: 20px;">
    <div class="row">
        <div class="col-12 mt-3 mb-3">
        <h1 class="text-white text-center">Caja !</h1>

        <div class="col-12">
            <input class="form-control" type="number" id="sumaSubtotales" readonly>
        </div>

        <div class="col-12">
            <div id="reader" style="width: 300px; height: 300px;"></div>
            <div id="result">
                <ul id="listaProductos"></ul>
            </div>
        </div>


    </div>
</section>

@endsection

@section('select2')
<script src="{{ asset('assets/admin/js/html5-qrcode.min.js')}}"></script>
<script>
    const html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: { width: 250, height: 250 } },
        { facingMode: "environment" }
    );

    // Variable para controlar el estado del escáner (habilitado/deshabilitado)
    let escanerHabilitado = true;
    // Array para almacenar los códigos de productos escaneados
    let productosEscaneados = [];

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    function onScanSuccess(result) {
        if (escanerHabilitado) {
            console.log(`Producto: ${result}`);
            mostrarNombreProducto(result);

            // Deshabilitar el escáner temporalmente para evitar escaneos múltiples
            escanerHabilitado = false;

            // Esperar 2 segundos y luego habilitar el escáner nuevamente
            setTimeout(function () {
                escanerHabilitado = true;
            }, 2000);
        }
    }

    function onScanFailure(error) {
        console.log(`Error al escanear: ${error}`);
    }

    function mostrarNombreProducto(codigo) {
        // Verificar si el producto ya ha sido escaneado
        if (productoYaEscaneado(codigo)) {
            console.log("Producto duplicado");
            return;
        }

        // Realizar una petición AJAX para obtener el nombre y el precio del producto según el código escaneado
        const url = "{{ route('obtener-nombre-producto') }}";
        const data = { codigo: codigo };

        // Ejemplo de petición AJAX con jQuery
        $.ajax({
            url: url,
            method: "GET",
            data: data,
            success: function (response) {
                if (response.nombre) {
                    // Crear un contenedor para el producto escaneado
                    const productoContainer = document.createElement("div");
                    productoContainer.classList.add("producto-container");

                    // Crear un div para el nombre del producto
                    const nombreDiv = document.createElement("div");
                    nombreDiv.innerHTML = `<p><strong>Nombre:</strong><br>${response.nombre}<br><strong>${response.precio}</strong></p>`;

                    // Crear un div para la cantidad del producto
                    const cantidadDiv = document.createElement("div");
                    cantidadDiv.innerHTML = '<p><strong>Cantidad:</strong><br></p>';
                    const cantidadInput = document.createElement("input");
                    cantidadInput.classList.add("form-control");
                    cantidadInput.type = "number";
                    cantidadInput.name = "cantidad[]";
                    cantidadInput.value = 1;
                    cantidadDiv.appendChild(cantidadInput);

                    // Crear un div para el subtotal del producto
                    const subtotalDiv = document.createElement("div");
                    subtotalDiv.innerHTML = '<p><strong>Subtotal:</strong><br></p>';
                    const subtotalInput = document.createElement("input");
                    subtotalInput.classList.add("form-control");
                    subtotalInput.type = "number";
                    subtotalInput.name = "subtotal[]";
                    subtotalDiv.appendChild(subtotalInput);

                    // Calcular el subtotal inicial multiplicando el precio por la cantidad
                    const precio = parseFloat(response.precio);
                    subtotalInput.value = (precio * cantidadInput.value).toFixed(2);

                    // Agregar los divs al contenedor del producto escaneado
                    productoContainer.appendChild(nombreDiv);
                    productoContainer.appendChild(cantidadDiv);
                    productoContainer.appendChild(subtotalDiv);

                    // Agregar el contenedor del producto escaneado al contenedor de la lista de productos escaneados
                    const listaProductos = document.getElementById("listaProductos");
                    listaProductos.appendChild(productoContainer);

                    // Agregar el código del producto escaneado al array
                    productosEscaneados.push(codigo);

                    // Reproducir un sonido al escanear el producto
                    reproducirSonido();

                    // Función para calcular el subtotal
                    function calcularSubtotal() {
                        const cantidad = parseFloat(cantidadInput.value);
                        subtotalInput.value = (precio * cantidad).toFixed(2);

                        // Actualizar la suma de los subtotales
                        actualizarSumaSubtotales();
                    }

                    // Asociar el evento "input" al input de cantidad
                    cantidadInput.addEventListener("input", calcularSubtotal);

                    // Asociar el evento "input" al input de precio
                    const precioInput = nombreDiv.querySelector("strong");
                    precioInput.addEventListener("input", calcularSubtotal);

                    // Actualizar la suma de los subtotales
                    actualizarSumaSubtotales();

                } else {
                    // Si no se encontró el producto, mostrar un mensaje indicando que no está disponible
                    console.log("Producto no encontrado");
                }
            },
            error: function (error) {
                console.log(`Error en la petición AJAX: ${error}`);
            }
        });
    }

    // Función para reproducir un sonido al escanear un producto
    function reproducirSonido() {
        const audio = new Audio("{{ asset('assets/admin/img/barras.mp3')}}");
        audio.play();
    }

    // Función para actualizar la suma de los subtotales
    function actualizarSumaSubtotales() {
        const subtotales = document.getElementsByName("subtotal[]");
        let sumaSubtotales = 0;

        // Sumar los subtotales de todos los productos escaneados
        for (let i = 0; i < subtotales.length; i++) {
            const subtotal = parseFloat(subtotales[i].value);
            if (!isNaN(subtotal)) {
                sumaSubtotales += subtotal;
            }
        }

        // Mostrar la suma de los subtotales en el campo de entrada correspondiente
        const sumaSubtotalesInput = document.getElementById("sumaSubtotales");
        sumaSubtotalesInput.value = sumaSubtotales.toFixed(2);
    }

    function productoYaEscaneado(codigo) {
        return productosEscaneados.includes(codigo);
    }


</script>

@endsection

