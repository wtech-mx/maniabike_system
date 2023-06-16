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
            <div id="result" style="background: #80CED7;padding: 10px; border-radius: 19px 19px 0px 0px ;color:#000">
            </div>
            <div id="resultados"></div>
        </div>

        <div class="col-12">
            <div class="container_request_qr mb-3"></div>
            {{-- <button id="resetScannerBtn" class="btn btn-primary">Resetear Scanner</button> --}}
            <button id="resetScannerBtn" class="btn btn-danger no_aparece mt-3">Reiniciar escáner</button>
            <button id="finalizarBtn" class="btn btn-primary">Finalizar</button>

        </div>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Camera <img src="{{ asset('assets/admin/img/icons/fotografia.png') }}" class="img_acrdion">
                </button>
              </h2>

              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                <button class="accordion-button mb-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                 Manual <img src="{{ asset('assets/admin/img/icons/teclado.png') }}" class="img_acrdion">
                </button>
              </h2>

              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" id="productForm" name="productForm" class="row">

                        <div class="col-12 mb-3">
                            <label class="text-white" for="validationCustom01">Ingresa el SKU del producto</label>
                            <input type="text" class="form-control" id="search"  name="search">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="validationCustom01">-</label>
                            <p class="text-center">
                                <a class="btn_save_scanner" type="submit" id="saveBtn" value="create" >Buscar</a>
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
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>
{{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> --}}

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type = "text/javascript">

$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });




$(document).ready(function() {

    // Función para calcular el total
    function calculateTotal() {
        var total = 0;

        $('.cantidad').each(function() {
            var cantidad = parseFloat($(this).val());
            var price = parseFloat($(this).closest('.row').find('.price').val());
            console.log(price);
            var subtotal = cantidad * price;
            total += subtotal;
        });

        // Aplica el descuento según el tipo seleccionado
        var tipo = $('#tipo').val();
        var descuento = parseFloat($('#descuento').val());

        if (tipo === 'Porcentaje') {
            total *= (100 - descuento) / 100;
        } else if (tipo === 'Fijo') {
            total -= descuento;
        }

        // Actualiza los campos de subtotal y total
        $('#subtotal').val(total.toFixed(2)); // Asegura que el subtotal tenga 2 decimales
        $('#total').val(total.toFixed(2)); // Asegura que el total tenga 2 decimales
    }


    // Evento click en el botón "Calcular"
    $(document).on('click', '#btnCalcular', function() {
      calculateTotal();
    });

    // Evento input en los campos de cantidad, precio, tipo y descuento
    $(document).on('input', '.cantidad, .price, #tipo, #descuento', function() {
      calculateTotal();
    });


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

      // Ocultar elementos de mayoreo al cargar la página
  $('.elemento-mayoreo').hide();

  // Asignar el controlador de eventos al select
  $(document).on('change', '#tipo_comprador', function() {
    var tipoComprador = $(this).val();

    if (tipoComprador === 'mayoreo') {
      // Mostrar elementos de mayoreo y ocultar elementos de minorista
      $('.elemento-minorista').hide();
      $('.elemento-mayoreo').show();
    } else if (tipoComprador === 'minorista') {
      // Mostrar elementos de minorista y ocultar elementos de mayoreo
      $('.elemento-mayoreo').hide();
      $('.elemento-minorista').show();
    }
  });

  // Desencadenar manualmente el evento change al cargar la página
  $('#tipo_comprador').trigger('change');

  });


let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  { facingMode: "environment" },
  /* verbose= */ false);
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


function onScanFailure(error) {
}

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
        url: '{{route('caja_search.caja')}}', // Ruta hacia tu controlador que manejará la búsqueda en la base de datos
        method: 'GET',
        data: { productos: productosEscaneados },
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

function obtenerProductosEscaneados() {
    const productosEscaneados = [];
    const productosHTML = document.getElementsByClassName('producto-escaneado');

    for (let i = 0; i < productosHTML.length; i++) {
        const codigo = productosHTML[i].textContent;
        productosEscaneados.push(codigo);
    }

    return productosEscaneados;
}


$(function () {
    $('#saveBtn').click(function (e) {
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
            success: function (response) {
                $('.container_request_qr').html(response); // renderizar la respuesta en el contenedor
            },
            error: function (xhr) {
                console.log(xhr.responseText); // mostrar mensaje de error en la consola
            }
        });
        }else{

        }

    });
});

$(function () {
  $('#resetBtn').click(function (e) {
    // Borra el contenido anterior
    $('#search').val('');
    $('.container_request_qr').empty();

    // Realiza una nueva búsqueda
    $('#saveBtn').trigger('click');
  });
});


  </script>

@endsection

