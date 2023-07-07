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
            <div id="reader" style="width: 300px; height: 300px;"></div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-minorista-tab" data-bs-toggle="pill" data-bs-target="#pills-minorista" type="button" role="tab" aria-controls="pills-minorista" aria-selected="true">Minorista</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-mayorista-tab" data-bs-toggle="pill" data-bs-target="#pills-mayorista" type="button" role="tab" aria-controls="pills-mayorista" aria-selected="false">Mayorista</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-minorista" role="tabpanel" aria-labelledby="pills-minorista-tab">
                    <div class="col-12">
                        <input class="form-control" type="number" id="sumaSubtotales" readonly>
                    </div>
                    <div id="result">
                        <ul id="listaProductos"></ul>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-mayorista" role="tabpanel" aria-labelledby="pills-mayorista-tab">
                    <div class="col-12">
                        <input class="form-control" type="number" id="sumaSubtotales2" readonly>
                    </div>
                    <div id="result">
                        <ul id="listaProductos2"></ul>
                    </div>
                </div>
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

    let escanerHabilitado = true;
    let productosEscaneados = [];

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    function onScanSuccess(result) {
        if (escanerHabilitado) {
            console.log(`Producto: ${result}`);
            mostrarNombreProducto(result);

            escanerHabilitado = false;
            setTimeout(function () {
                escanerHabilitado = true;
            }, 2000);
        }
    }

    function onScanFailure(error) {
        console.log(`Error al escanear: ${error}`);
    }

    function mostrarNombreProducto(codigo) {
        if (productoYaEscaneado(codigo)) {
            console.log("Producto duplicado");
            return;
        }

        const url = "{{ route('obtener-nombre-producto') }}";
        const data = { codigo: codigo };

        $.ajax({
            url: url,
            method: "GET",
            data: data,
            success: function (response) {
                if (response.nombre) {
                    const productoContainer = document.createElement("div");
                    productoContainer.classList.add("producto-container");

                    const nombreDiv = document.createElement("div");
                    nombreDiv.innerHTML = `<p><strong>Nombre:</strong><br>${response.nombre}</p>`;

                    const precioDiv = document.createElement("div");
                    precioDiv.innerHTML = `<label for="precio">Precio:</label><input class="form-control" type="number" name="precio[]" value="${response.precio}" data-precio-mayo="${response.precio_mayo || ''}">`;

                    const cantidadDiv = document.createElement("div");
                    cantidadDiv.innerHTML = '<p><strong>Cantidad:</strong><br></p>';
                    const cantidadInput = document.createElement("input");
                    cantidadInput.classList.add("form-control");
                    cantidadInput.type = "number";
                    cantidadInput.name = "cantidad[]";
                    cantidadInput.value = 1;
                    cantidadDiv.appendChild(cantidadInput);

                    const subtotalDiv = document.createElement("div");
                    subtotalDiv.innerHTML = '<p><strong>Subtotal:</strong><br></p>';
                    const subtotalInput = document.createElement("input");
                    subtotalInput.classList.add("form-control");
                    subtotalInput.type = "number";
                    subtotalInput.name = "subtotal[]";
                    subtotalDiv.appendChild(subtotalInput);

                    const precio = parseFloat(response.precio);
                    subtotalInput.value = (precio * cantidadInput.value).toFixed(2);

                    productoContainer.appendChild(nombreDiv);
                    productoContainer.appendChild(precioDiv);
                    productoContainer.appendChild(cantidadDiv);
                    productoContainer.appendChild(subtotalDiv);

                    const listaProductos = document.getElementById("listaProductos");
                    listaProductos.appendChild(productoContainer);



                    const productoContainer2 = document.createElement("div");
                    productoContainer2.classList.add("producto-container2");

                    const nombreDiv2 = document.createElement("div");
                    nombreDiv2.innerHTML = `<p><strong>Nombre:</strong><br>${response.nombre}</p>`;

                    const precioDiv2 = document.createElement("div");
                    precioDiv2.innerHTML = `<label for="precio">Precio:</label><input class="form-control" type="number" name="precio2[]" value="${response.precio_mayo}">`;

                    const cantidadDiv2 = document.createElement("div");
                    cantidadDiv2.innerHTML = '<p><strong>Cantidad:</strong><br></p>';
                    const cantidadInput2 = document.createElement("input");
                    cantidadInput2.classList.add("form-control");
                    cantidadInput2.type = "number";
                    cantidadInput2.name = "cantidad2[]";
                    cantidadInput2.value = 1;
                    cantidadDiv2.appendChild(cantidadInput2);

                    const subtotalDiv2 = document.createElement("div");
                    subtotalDiv2.innerHTML = '<p><strong>Subtotal:</strong><br></p>';
                    const subtotalInput2 = document.createElement("input");
                    subtotalInput2.classList.add("form-control");
                    subtotalInput2.type = "number";
                    subtotalInput2.name = "subtotal2[]";
                    subtotalDiv2.appendChild(subtotalInput2);

                    const precio2 = parseFloat(response.precio_mayo);
                    subtotalInput2.value = (precio2 * cantidadInput2.value).toFixed(2);

                    productoContainer2.appendChild(nombreDiv2);
                    productoContainer2.appendChild(precioDiv2);
                    productoContainer2.appendChild(cantidadDiv2);
                    productoContainer2.appendChild(subtotalDiv2);

                    const listaProductos2 = document.getElementById("listaProductos2");
                    listaProductos2.appendChild(productoContainer2);

                    productosEscaneados.push(codigo);

                    reproducirSonido();

                    function calcularSubtotal2() {
                        const precio2 = parseFloat(precioDiv2.querySelector("input[name='precio2[]']").value);
                        const cantidad2 = parseFloat(cantidadInput2.value);
                        subtotalInput2.value = (precio2 * cantidad2).toFixed(2);
                        actualizarSumaSubtotales2();
                    }

                    cantidadInput2.addEventListener("input", calcularSubtotal2);
                    precioDiv2.querySelector("input[name='precio2[]']").addEventListener("input", calcularSubtotal2);

                    actualizarSumaSubtotales2();


                    function calcularSubtotal() {
                        const precio = parseFloat(precioDiv.querySelector("input[name='precio[]']").value);
                        const cantidad = parseFloat(cantidadInput.value);
                        subtotalInput.value = (precio * cantidad).toFixed(2);
                        actualizarSumaSubtotales();
                    }

                    cantidadInput.addEventListener("input", calcularSubtotal);
                    precioDiv.querySelector("input[name='precio[]']").addEventListener("input", calcularSubtotal);

                    actualizarSumaSubtotales();
                } else {
                    console.log("Producto no encontrado");
                }
            },
            error: function (error) {
                console.log(`Error en la petición AJAX: ${error}`);
            }
        });
    }

    function reproducirSonido() {
        const audio = new Audio("{{ asset('assets/admin/img/barras.mp3')}}");
        audio.play();
    }

    function actualizarSumaSubtotales() {
        const subtotales = document.getElementsByName("subtotal[]");
        let sumaSubtotales = 0;

        for (let i = 0; i < subtotales.length; i++) {
            const subtotal = parseFloat(subtotales[i].value);
            if (!isNaN(subtotal)) {
                sumaSubtotales += subtotal;
            }
        }

        const sumaSubtotalesInput = document.getElementById("sumaSubtotales");
        sumaSubtotalesInput.value = sumaSubtotales.toFixed(2);
    }

    function actualizarSumaSubtotales2() {
        const subtotales2 = document.getElementsByName("subtotal2[]");
        let sumaSubtotales2 = 0;

        for (let i = 0; i < subtotales2.length; i++) {
            const subtotal2 = parseFloat(subtotales2[i].value);
            if (!isNaN(subtotal2)) {
                sumaSubtotales2 += subtotal2;
            }
        }

        const sumaSubtotalesInput2 = document.getElementById("sumaSubtotales2");
        sumaSubtotalesInput2.value = sumaSubtotales2.toFixed(2);
    }

    function productoYaEscaneado(codigo) {
        return productosEscaneados.includes(codigo);
    }



</script>

@endsection

