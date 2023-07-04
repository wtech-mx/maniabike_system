@extends('layouts.app_admin')

@section('template_title')
    Caja
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/servicios.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/scanner.css') }}">
    <style>
        .producto-escaneado {
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
                    <div id="result"
                        style="background: #80CED7;padding: 10px; border-radius: 19px 19px 0px 0px ;color:#000">
                    </div>
                    <div id="resultados"></div>
                </div>
                <div class="col-12">
                    <div class="container_request_qr mb-3"></div>
                    {{-- <button id="resetScannerBtn" class="btn btn-primary">Resetear Scanner</button> --}}

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-minorista-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-minorista" type="button" role="tab"
                                        aria-controls="pills-minorista" aria-selected="true">Minorista</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-mayorista-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-mayorista" type="button" role="tab"
                                        aria-controls="pills-mayorista" aria-selected="false">Mayorista</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-minorista" role="tabpanel"
                                    aria-labelledby="pills-minorista-tab">
                                    <form class="row" method="POST" action="{{ route('caja.store') }}"
                                        enctype="multipart/form-data" role="form">
                                        <input type="hidden" name="_token" value="'. csrf_token() .'" />

                                        <div class="col-6">
                                            <p class=""><strong class="">Nombre: </strong> <br><br><strong
                                                    class=""> </strong></p>
                                        </div>
                                        <input class="form-control" type="hidden" name="id_product[]" id="id_product"
                                            value="">
                                        <div class="col-3">
                                            <p class=""><strong class="">Cantidad: </strong> <br></p>
                                            <input class="form-control cantidad" type="number" name="cantidad[]"
                                                id="cantidad" value="1">
                                        </div>
                                        <div class="col-3 ">
                                            <p class=""><strong class="">Precio: </strong> <br></p>
                                            <input class="form-control precio" type="number" name="price[]" id="price"
                                                value="">
                                        </div>
                                        <div class="col-6">
                                        </div>
                                        <div class="col-3">
                                            <p class=""><strong class="">Tipo :</strong></span></p>
                                            <select class="form-select" name="tipo" id="tipo">
                                                <option selected>Ninguno</option>
                                                <option value="Porcentaje">Porcentaje</option>
                                                <option value="Fijo">Fijo</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <p class=""><strong class="">Descuento: </strong></span></p>
                                            <input class="form-control" type="number" name="descuento" id="descuento"
                                                value="0">
                                        </div>
                                        <div class="col-12">
                                            <p class=""><strong class="">Método de pago : </strong></span></p>
                                            <select class="form-select" name="metodo_pago" id="metodo_pago">
                                                <option selected>Selecciona Método de Pago</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Tarjeta">Tarjeta crédito/débito</option>
                                                <option value="Transferencia">Transferencia</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <p class=""><strong class="">Comentario : </strong></span></p>
                                            <textarea class="form-control" name="comentario" id="comentario" rows="2"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <p class=""><strong class="">Comprobante : </strong></span></p>
                                            <input class="form-control" type="file" name="comprobante"
                                                id="comprobante" value="">
                                        </div>
                                        <div class="col-6 mt-2">
                                            <p class=""><strong class=""></strong><span
                                                    class="total"></span></p>
                                            <button id="btnCalcular" class="btn btn-primary"
                                                type="button">Calcular</button>
                                        </div>
                                        <div class="col-3 mt-2">
                                            <p class=""><strong class="">Subtotal : </strong></span></p>
                                            <input class="form-control" type="number" name="subtotal" id="subtotal"
                                                value="">
                                        </div>
                                        <div class="col-3 mt-2">
                                            <p class=""><strong class="">Total : </strong></span></p>
                                            <input class="form-control" type="number" name="total" id="total"
                                                value="">
                                        </div>
                                        <div class="col-6 mt-2">
                                        </div>
                                        <div class="col-6 mt-2">
                                            <button type="submit" class="btn btn-primary"
                                                style="width: 100%">Guardar</button>
                                        </div>
                                    </form>
                                </div>

                            <div class="tab-pane fade" id="pills-mayorista" role="tabpanel"
                                aria-labelledby="pills-mayorista-tab">
                                <form class="row" method="POST" action="{{ route('caja.store') }}"
                                    enctype="multipart/form-data" role="form">
                                    <input type="hidden" name="_token" value="'. csrf_token() .'" />
                                    <div class="col-6">
                                        <p class=""><strong class="">Nombre: </strong> <br><br><strong
                                                class=""> </strong></p>
                                    </div>
                                    <input class="form-control" type="hidden" name="id_product[]" id="id_product"
                                        value="">
                                    <div class="col-3">
                                        <p class=""><strong class="">Cantidad: </strong> <br></p>
                                        <input class="form-control cantidad2" type="number" name="cantidad2"
                                            id="cantidad2" value="1">
                                    </div>
                                    <div class="col-3 ">
                                        <p class=""><strong class="">Mayoreo: </strong> <br></p>
                                        <input class="form-control price2" type="text" name="price2" id="price2"
                                            value="'">
                                    </div>
                                    <div class="col-6">
                                    </div>
                                    <div class="col-3">
                                        <p class=""><strong class="">Tipo :</strong></span></p>
                                        <select class="form-select" name="tipo" id="tipo">
                                            <option selected>Ninguno</option>
                                            <option value="Porcentaje">Porcentaje</option>
                                            <option value="Fijo">Fijo</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <p class=""><strong class="">Descuento: </strong></span></p>
                                        <input class="form-control" type="number" name="descuento" id="descuento"
                                            value="0">
                                    </div>
                                    <div class="col-12">
                                        <p class=""><strong class="">Método de pago : </strong></span></p>
                                        <select class="form-select" name="metodo_pago" id="metodo_pago">
                                            <option selected>Selecciona Método de Pago</option>
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Tarjeta">Tarjeta crédito/débito</option>
                                            <option value="Transferencia">Transferencia</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <p class=""><strong class="">Comentario : </strong></span></p>
                                        <textarea class="form-control" name="comentario" id="comentario" rows="2"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <p class=""><strong class="">Comprobante : </strong></span></p>
                                        <input class="form-control" type="file" name="comprobante" id="comprobante"
                                            value="">
                                    </div>
                                    <div class="col-6 mt-2">
                                        <p class=""><strong class=""></strong><span class="total"></span>
                                        </p>
                                        <button id="" class="btn btn-primary" type="button">Calcular2</button>
                                    </div>
                                    <div class="col-3 mt-2">
                                        <p class=""><strong class="">Subtotal : </strong></span></p>
                                        <input class="form-control" type="number" name="subtotal" id="subtotal"
                                            value="">
                                    </div>
                                    <div class="col-3 mt-2">
                                        <p class=""><strong class="">Total : </strong></span></p>
                                        <input class="form-control" type="number" name="total" id="total"
                                            value="">
                                    </div>
                                    <div class="col-6 mt-2">
                                    </div>
                                    <div class="col-6 mt-2">
                                        <button type="submit" class="btn btn-primary"
                                            style="width: 100%">Guardar</button>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
            <button id="finalizarBtn" class="btn btn-primary">Finalizar</button>
        </div>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button mb-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Camera <img src="{{ asset('assets/admin/img/icons/fotografia.png') }}" class="img_acrdion">
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="col-12">
                            <div class="content_qr">
                                <div id="reader"></div>
                                <div id="result"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button mb-3 collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Manual <img src="{{ asset('assets/admin/img/icons/teclado.png') }}" class="img_acrdion">
                    </button>
                </h2>

                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="" id="productForm" name="productForm" class="row">

                            <div class="col-12 mb-3">
                                <label class="text-white" for="validationCustom01">Ingresa el SKU del producto</label>
                                <input type="text" class="form-control" id="search" name="search">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="validationCustom01">-</label>
                                <p class="text-center">
                                    <a class="btn_save_scanner" type="submit" id="saveBtn" value="create">Buscar</a>
                                    <a id="resetBtn">Resetear</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('select2')
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"
        integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });


        $(document).ready(function() {

            // Evento change en el select de método de pago
            $(document).on('change', '#metodo_pago', function() {
                var metodoPago = $(this).val();
                var comprobanteInput = $('#comprobante').closest('.col-12');
                if (metodoPago === 'Transferencia') {
                    comprobanteInput.show();
                } else {
                    comprobanteInput.hide();
                }
            });

        });


        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            }, {
                facingMode: "environment"
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        function onScanSuccess(result, decodedResult) {
            console.log(`Producto: ${result}`);

            // Verificar si el producto ya ha sido escaneado
            if (productoYaEscaneado(result)) {
                mostrarOpcionesDuplicado(result);
            } else {
                // Agregar la información del producto a la lista
                agregarProductoEscaneado(result);

                // Limpiar el resultado del escaneo
                scanner.clear();
            }
        }

        function productoYaEscaneado(codigo) {
            const productosHTML = document.getElementsByClassName('producto-escaneado');

            for (let i = 0; i < productosHTML.length; i++) {
                if (productosHTML[i].textContent === codigo) {
                    return true;
                }
            }

            return false;
        }

        function mostrarOpcionesDuplicado(codigo) {
            Swal.fire({
                title: 'Producto duplicado',
                text: 'El producto ya ha sido escaneado. ¿Deseas agregar otro?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Sí'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Agregar el producto duplicado a la lista
                    agregarProductoEscaneado(codigo);

                    // Limpiar el resultado del escaneo
                    scanner.clear();
                } else {
                    // No hacer nada, ignorar el duplicado
                }
            });
        }


        function onScanFailure(error) {}

        document.getElementById('resetScannerBtn').addEventListener('click', () => {
            resetScanner();
        });

        function resetScanner() {
            html5QrcodeScanner.clear();
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            $('.container_request_qr').empty();
            document.getElementById('result').innerHTML = '';
        }

        function obtenerProductosEscaneados() {
            const productosEscaneados = [];
            const productosHTML = document.getElementsByClassName('producto-escaneado');

            for (let i = 0; i < productosHTML.length; i++) {
                const codigo = productosHTML[i].textContent;
                productosEscaneados.push(codigo);
            }

            return productosEscaneados;
        }

        function agregarProductoEscaneado(codigo) {
            const listaProductos = document.getElementById('resultados');

            const productoHTML = document.createElement('li');
            productoHTML.classList.add('producto-escaneado');
            productoHTML.textContent = codigo;

            listaProductos.appendChild(productoHTML);
        }

        document.getElementById('finalizarBtn').addEventListener('click', () => {
            finalizarEscaneo();
        });

        function finalizarEscaneo() {
            // Obtener la lista de productos escaneados
            const productosEscaneados = obtenerProductosEscaneados();

            // Realizar la búsqueda en la base de datos
            buscarProductosEnDB(productosEscaneados);
        }

        function buscarProductosEnDB(productosEscaneados) {
            // Realizar una petición AJAX para buscar los productos en tu base de datos
            $.ajax({
                url: '{{ route('caja_search.caja') }}', // Ruta hacia tu controlador que manejará la búsqueda en la base de datos
                method: 'GET',
                data: {
                    productos: productosEscaneados
                },
                success: function(response) {
                    // Aquí puedes manejar la respuesta del servidor y mostrar los resultados en tu página
                    $('.container_request_qr').html(response);
                    //console.log(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function actualizarTotal() {
            var total = 0;
            $('.cantidad').each(function() {
                var cantidad = $(this).val();
                var precio = $(this).closest('.col-3').find('.precio').val();
                total += cantidad * precio;
            });
            $('#total').val(total);
        }

        $('.cantidad, .precio').on('change', function() {
            actualizarTotal();
        });

        function obtenerProductosEscaneados() {
            const productosEscaneados = [];
            const productosHTML = document.getElementsByClassName('producto-escaneado');

            for (let i = 0; i < productosHTML.length; i++) {
                const codigo = productosHTML[i].textContent;
                productosEscaneados.push(codigo);
            }

            return productosEscaneados;
        }


        $(function() {
            $('#saveBtn').click(function(e) {
                e.preventDefault(); // prevenir el comportamiento por defecto del botón

                var search = $('#search').val(); // obtener el valor del input de búsqueda

                if (search !== '') {
                    $.ajax({
                        url: '{{ route('scanner.search') }}',
                        type: 'get',
                        dataType: 'html',
                        data: {
                            'search': search
                        },
                        success: function(response) {
                            $('.container_request_qr').html(
                            response); // renderizar la respuesta en el contenedor
                        },
                        error: function(xhr) {
                            console.log(xhr
                            .responseText); // mostrar mensaje de error en la consola
                        }
                    });
                } else {

                }

            });
        });

        $(function() {
            $('#resetBtn').click(function(e) {
                // Borra el contenido anterior
                $('#search').val('');
                $('.container_request_qr').empty();

                // Realiza una nueva búsqueda
                $('#saveBtn').trigger('click');
            });
        });
    </script>
@endsection
