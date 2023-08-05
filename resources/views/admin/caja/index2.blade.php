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


        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Camera <img src="{{ asset('assets/admin/img/icons/fotografia.png') }}" class="img_acrdion">
                </button>
              </h2>

              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body row">

                    <div class="col-12">
                        <div class="content_qr">
                            <div id="reader"></div>
                            <div id="result"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-minorista-tab" data-bs-toggle="pill" data-bs-target="#pills-minorista" type="button" role="tab" aria-controls="pills-minorista" aria-selected="true">Minorista</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-mayorista-tab" data-bs-toggle="pill" data-bs-target="#pills-mayorista" type="button" role="tab" aria-controls="pills-mayorista" aria-selected="false">Mayorista</button>
                            </li>
                        </ul>
                    </div>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-minorista" role="tabpanel" aria-labelledby="pills-minorista-tab">
                                <form id="miFormulario" class="row" method="POST" action="{{route('caja.store')}}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <div class="col-12">
                                            <div class="form-group">
                                                <label class="text-white" for="precio">Cliente</label><br>
                                                <select class="form-control client"  data-toggle="select" id="id_client" name="id_client" value="{{ old('submarca') }}">
                                                    <option value="1">Seleccionar cliente</option>
                                                    @foreach ($customerUsernames as $customer)
                                                        <option value="{{ $customer['id'] }}">{{ $customer['first_name'] }} {{ $customer['last_name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="text-white" for="precio">Nuevo cliente minorsita</label><br>
                                        <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Agregar
                                        </button>
                                    </div>
                                    <div class="col-12">
                                            <div class="form-group">
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body">
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="nombre">Nombre *</label>
                                                                <input  id="nombre" name="nombre" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="nombre">Apellido *</label>
                                                                <input  id="apellido" name="apellido" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="nombre">Telefono *</label>
                                                                <input class="form-control" type="tel" minlength="10" maxlength="10" id="telefono" name="telefono" placeholder="55-55-55-55-55" >
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="nombre">Correo</label>
                                                                <input  id="email" name="email" type="email" class="form-control">
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div id="result">
                                        <div id="listaProductos"></div>
                                    </div>

                                    <div class="col-6 mt-3 mb-3">
                                        <p class="text-white"><strong class="">Método de pago</strong></span></p>
                                        <select class="form-select" name="metodo_pago" id="metodo_pago" required>
                                            <option value="">Selecciona Método de Pago</option>
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Tarjeta">Tarjeta crédito/débito</option>
                                            <option value="Transferencia">Transferencia</option>
                                            <option value="Deudor">Deudor</option>
                                        </select>
                                    </div>

                                    <div class="col-6 mt-3 mb-2 comprobante_dv">
                                        <p class=""><strong class="">Comprobante</strong></span></p>
                                        <input class="form-control" type="file" name="comprobante" id="comprobante" value="">
                                    </div>

                                    <div class="col-6 mt-3 mb-2 saldo_favor_dv">
                                        <p class=""><strong class="">Saldo a favor</strong></span></p>
                                        <input class="form-control" type="number" id="saldo_favor" name="saldo_favor" placeholder="Monto a favor">
                                    </div>

                                    <div class="col-6 mt-3 mb-2">
                                        <p class=""><strong class="">Total</strong></span></p>
                                        <input class="form-control" type="number" id="sumaSubtotales" name="total" readonly>
                                    </div>

                                    <div class="col-6">
                                    </div>
                                    <div class="col-6 mt-3">
                                        <button type="submit" id="submitBtn" class="btn btn-success" style="width:100%">
                                            <i class='fas fa-save'></i> Guardar</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-mayorista" role="tabpanel" aria-labelledby="pills-mayorista-tab">
                                <form class="row" id="miFormulario" method="POST" action="{{route('caja.store2')}}" enctype="multipart/form-data" role="form">
                                    @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="text-white" for="precio">Cliente</label><br>
                                                <select class="form-control cliente2"  data-toggle="select" id="id_client2" name="id_client2" value="{{ old('submarca') }}">
                                                    <option value="1">Seleccionar cliente</option>
                                                    @foreach ($customerUsernames2 as $customer)
                                                        <option value="{{ $customer['id'] }}">{{ $customer['first_name'] }} {{ $customer['last_name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="text-white" for="precio">Nuevo cliente mayorsita</label><br>
                                            <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Agregar
                                            </button>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="nombre">Nombre *</label>
                                                                    <input  id="nombre2" name="nombre2" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="nombre">Apellido *</label>
                                                                    <input  id="apellido2" name="apellido2" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="nombre">Telefono *</label>
                                                                    <input class="form-control" type="tel" minlength="10" maxlength="10" id="telefono2" name="telefono2" placeholder="55-55-55-55-55" >
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="nombre">Correo</label>
                                                                    <input  id="email2" name="email2" type="email" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div id="result">
                                            <div id="listaProductos2"></div>
                                        </div>

                                        <div class="col-6 mt-3 mb-3">
                                            <p class="text-white"><strong class="">Método de pago</strong></span></p>
                                            <select class="form-select" name="metodo_pago2" id="metodo_pago2" required>
                                                <option value="">Selecciona Método de Pago</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Tarjeta">Tarjeta crédito/débito</option>
                                                <option value="Transferencia">Transferencia</option>
                                                <option value="Deudor">Deudor</option>
                                            </select>
                                        </div>

                                        <div class="col-6 mt-3 mb-2 comprobante_dv2">
                                            <p class=""><strong class="">Comprobante</strong></span></p>
                                            <input class="form-control" type="file" name="comprobante2" id="comprobante2" value="">
                                        </div>

                                        <div class="col-6 mt-3 mb-2 saldo_favor_dv2">
                                            <p class=""><strong class="">Saldo a favor</strong></span></p>

                                            <input class="form-control" type="number" id="saldo_favor2" name="saldo_favor2" placeholder="Monto a favor">
                                        </div>

                                        <div class="col-6 mt-3 mb-2">
                                            <p class=""><strong class="">Total</strong></span></p>
                                            <input class="form-control" type="number" id="sumaSubtotales2" name="total2" readonly>
                                        </div>

                                        <div class="col-6">
                                        </div>

                                        <div class="col-6 mt-3">
                                            <button type="submit" id="submitBtn" class="btn btn-success" style="width:100%">
                                                <i class='fas fa-save'></i> Guardar</button>
                                        </div>

                                </form>
                            </div>
                        </div>

                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button mb-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                 Manual <img src="{{ asset('assets/admin/img/icons/teclado.png') }}" class="img_acrdion">
                </button>
              </h2>

              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                </div>
              </div>
            </div>
        </div>

    </div>
</section>

@endsection

@section('select2')
<script src="{{ asset('assets/admin/js/html5-qrcode.min.js')}}"></script><script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

<script>
    // Función para mostrar u ocultar el div del comprobante y saldo a favor
    function toggleDivs() {
        var metodo_pago = document.getElementById("metodo_pago").value;
        var comprobanteDiv = document.querySelector(".comprobante_dv");
        var saldoFavorDiv = document.querySelector(".saldo_favor_dv");

        if (comprobanteDiv) {
            comprobanteDiv.style.display = metodo_pago === "Transferencia" ? "block" : "none";
        }

        if (saldoFavorDiv) {
            saldoFavorDiv.style.display = metodo_pago === "Deudor" ? "block" : "none";
        }
    }

    function toggleDivs2() {
        var metodo_pago2 = document.getElementById("metodo_pago2").value;
        var comprobanteDiv2 = document.querySelector(".comprobante_dv2");
        var saldoFavorDiv2 = document.querySelector(".saldo_favor_dv2");

        if (comprobanteDiv2) {
            comprobanteDiv2.style.display = metodo_pago2 === "Transferencia" ? "block" : "none";
        }

        if (saldoFavorDiv2) {
            saldoFavorDiv2.style.display = metodo_pago2 === "Deudor" ? "block" : "none";
        }
    }

    // Agregar evento para ejecutar la función al cambiar el select
    document.getElementById("metodo_pago").addEventListener("change", toggleDivs);
    document.getElementById("metodo_pago2").addEventListener("change", toggleDivs2);

    // Ejecutar la función inicialmente para que se muestre u oculte según el valor inicial del select
    toggleDivs();
    toggleDivs2();

    $(document).ready(function() {
        $('.client').select2();
        $('.cliente2').select2();
    });

    const html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",

        { fps: 5, qrbox: {width: 250, height: 250} },
        { facingMode: "environment" },
        /* verbose= */ false);

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
            }, 5000);

            const audio = new Audio("{{ asset('assets/admin/img/barras.mp3')}}");
            audio.play();
        }
    }

    function onScanFailure(error) {
        if (error !== "NotFound") {
            console.log(`Error al escanear: ${error}`);
        }
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
                    productoContainer.classList.add("row");

                    const nombreDiv = document.createElement("div");
                    nombreDiv.classList.add("col-6");
                    nombreDiv.innerHTML = `<p style="text-align: left;margin-top:2rem;"><strong>Nombre:</strong></p><p style="font-size:12px;text-align: left;">${response.nombre}</p>`;

                    const inputnombreDiv = document.createElement("div");
                    inputnombreDiv.classList.add("d-none");
                    inputnombreDiv.innerHTML = `<input type="hidden" name="name[]" value="${response.nombre}">`;

                    const idDiv = document.createElement("div");
                    idDiv.classList.add("d-none");
                    idDiv.innerHTML = `<p style="text-align: left;margin-top:2rem;"><strong>id:</strong></p><input class="form-control" type="hidden" name="id[]" value="${response.id}">`;

                    const precioDiv = document.createElement("div");
                    precioDiv.classList.add("col-3");
                    precioDiv.innerHTML = `<p style="text-align: left;margin-top:2rem;"><strong>Precio:</strong></p><input class="form-control" type="number" name="precio[]" value="${response.precio}" data-precio-mayo="${response.precio_mayo || ''}">`;

                    const cantidadDiv = document.createElement("div");
                    cantidadDiv.classList.add("col-3");
                    cantidadDiv.innerHTML = '<p style="text-align: left;margin-top:2rem;"><strong>Cantidad:</strong><br></p>';

                    const cantidadInput = document.createElement("input");
                    cantidadInput.classList.add("form-control");
                    cantidadInput.type = "number";
                    cantidadInput.name = "cantidad[]";
                    cantidadInput.value = 1;
                    cantidadDiv.appendChild(cantidadInput);

                    //const sespaciolDiv = document.createElement("div");
                    //sespaciolDiv.classList.add("col-6");
                    // sespaciolDiv.innerHTML = '<p>-</p>';

                    const eliminarBtn = document.createElement("button");
                    eliminarBtn.classList.add("btn", "btn-danger", "eliminar-btn","col-6");
                    eliminarBtn.innerHTML = "<i class='fas fa-trash'></i>";
                    eliminarBtn.addEventListener("click", eliminarProducto);
                    productoContainer.appendChild(eliminarBtn);

                    const subtotalDiv = document.createElement("div");
                    subtotalDiv.classList.add("col-6");
                    // subtotalDiv.innerHTML = '<p><strong>Subtotal:</strong><br></p>';

                    const subtotalInput = document.createElement("input");
                    subtotalInput.classList.add("form-control");
                    subtotalInput.type = "number";
                    subtotalInput.name = "subtotal[]";
                    subtotalDiv.appendChild(subtotalInput);

                    const precio = parseFloat(response.precio);
                    subtotalInput.value = (precio * cantidadInput.value).toFixed(2);

                    productoContainer.appendChild(nombreDiv);
                    productoContainer.appendChild(inputnombreDiv);
                    productoContainer.appendChild(precioDiv);
                    productoContainer.appendChild(idDiv);
                    productoContainer.appendChild(cantidadDiv);
                    productoContainer.appendChild(eliminarBtn);
                    productoContainer.appendChild(subtotalDiv);

                    const listaProductos = document.getElementById("listaProductos");
                    listaProductos.appendChild(productoContainer);

                    const productoContainer2 = document.createElement("div");
                    productoContainer2.classList.add("producto-container2");
                    productoContainer2.classList.add("row");

                    const nombreDiv2 = document.createElement("div");
                    nombreDiv2.classList.add("col-6");
                    nombreDiv2.innerHTML = `<p style="text-align: left;margin-top:2rem;"><strong>Nombre:</strong></p><p style="font-size:12px;text-align: left;">${response.nombre}</p>`;

                    const inputnombreDiv2 = document.createElement("div");
                    inputnombreDiv2.classList.add("d-none");
                    inputnombreDiv2.innerHTML = `<input type="hidden" name="name2[]" value="${response.nombre}">`;

                    const idDiv2 = document.createElement("div");
                    idDiv2.classList.add("d-none");
                    idDiv2.innerHTML = `<p style="text-align: left;margin-top:2rem;"><strong>id:</strong></p><input class="form-control" type="hidden" name="id2[]" value="${response.id}">`;

                    const precioDiv2 = document.createElement("div");
                    precioDiv2.classList.add("col-3");
                    precioDiv2.innerHTML = `<p style="text-align: left;margin-top:2rem;"><strong>Precio:</strong></p><input class="form-control" type="number" name="precio2[]" value="${response.precio_mayo}">`;

                    const cantidadDiv2 = document.createElement("div");
                    cantidadDiv2.classList.add("col-3");
                    cantidadDiv2.innerHTML = '<p style="text-align: left;margin-top:2rem;"><strong>Cantidad:</strong><br></p>';

                    const cantidadInput2 = document.createElement("input");
                    cantidadInput2.classList.add("form-control");
                    cantidadInput2.type = "number";
                    cantidadInput2.name = "cantidad2[]";
                    cantidadInput2.value = 1;
                    cantidadDiv2.appendChild(cantidadInput2);

                    const sespaciolDiv2 = document.createElement("div");
                    sespaciolDiv2.classList.add("col-6");

                    const eliminarBtn2 = document.createElement("button");
                    eliminarBtn2.classList.add("btn", "btn-danger", "eliminar-btn","col-6");
                    eliminarBtn2.innerHTML = "<i class='fas fa-trash'></i>";
                    eliminarBtn2.addEventListener("click", eliminarProducto2);
                    productoContainer.appendChild(eliminarBtn2);

                    const subtotalDiv2 = document.createElement("div");
                    subtotalDiv2.classList.add("col-6");
                    //subtotalDiv2.innerHTML = '<p><strong>Subtotal:</strong><br></p>';

                    const subtotalInput2 = document.createElement("input");
                    subtotalInput2.classList.add("form-control");
                    subtotalInput2.type = "number";
                    subtotalInput2.name = "subtotal2[]";
                    subtotalDiv2.appendChild(subtotalInput2);

                    const precio2 = parseFloat(response.precio_mayo);
                    subtotalInput2.value = (precio2 * cantidadInput2.value).toFixed(2);

                    productoContainer2.appendChild(nombreDiv2);
                    productoContainer2.appendChild(inputnombreDiv2);
                    productoContainer2.appendChild(idDiv2);
                    productoContainer2.appendChild(precioDiv2);
                    productoContainer2.appendChild(cantidadDiv2);
                    productoContainer2.appendChild(eliminarBtn2);
                    productoContainer2.appendChild(subtotalDiv2);

                    const listaProductos2 = document.getElementById("listaProductos2");
                    listaProductos2.appendChild(productoContainer2);

                    productosEscaneados.push(codigo);

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

    // Función para eliminar un producto escaneado
    function eliminarProducto() {
        const productoContainer = this.parentNode;
        const productoId = productoContainer.querySelector("input[name='id[]']").value;

        // Eliminar el contenedor del producto escaneado de la lista
        productoContainer.remove();

        // Eliminar el producto de la lista de productos escaneados
        const index = productosEscaneados.indexOf(productoId);
        if (index > -1) {
            productosEscaneados.splice(index, 1);
        }

        // Recalcular los subtotales
        actualizarSumaSubtotales();
    }

    // Función para eliminar un producto escaneado en Mayorista
    function eliminarProducto2() {
        const productoContainer = this.parentNode;
        const productoId = productoContainer.querySelector("input[name='id2[]']").value;

        // Eliminar el contenedor del producto escaneado de la lista
        productoContainer.remove();

        // Eliminar el producto de la lista de productos escaneados
        const index = productosEscaneados.indexOf(productoId);
        if (index > -1) {
            productosEscaneados.splice(index, 1);
        }

        // Recalcular los subtotales
        actualizarSumaSubtotales2();
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

