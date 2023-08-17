@extends('layouts.app_admin')

@section('template_title')
    Scanear Servicios
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/servicios.css')}}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/scanner.css')}}">
@endsection

@section('content')
<section class="servicios" style="min-height:auto;padding: 20px;">
    <div class="row">
        <div class="col-12 mt-3 mb-3">
        <h1 class="text-white text-center">¡Scanner Servicios !</h1>

        <div class="col-12" style="padding: 0!important;">
            <div class="d-flex justify-content-center mt-5 mb-5">

                <a class="btn_servicio" href="#">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lupa_list.png') }}" alt="">
                    <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Servicios</p>
                </a>

                <a class="btn_servicio_p" href="{{ route('scanner_products.index') }}">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lupa_list.png') }}" alt="">
                    <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Productos</p>
                </a>

            </div>
        </div>

        <div class="col-12">
            <div id="servicio-data">
                @isset($products)
                    <div class="row">
                        <div class="col-12">
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Folio:</strong>{{$products->folio}}</p>
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Estatus:</strong>{{$products->estatus}}</p>
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Cliente:</strong>{{$products->Cliente->nombre}}</p>
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Telefono:</strong><a href="https://api.whatsapp.com/send?phone=521{{$products->Cliente->telefono}}"></a>{{$products->Cliente->telefono}}</p>
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Fecha:</strong>{{$products->fecha}}</p>
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Bicicleta:</strong>  {{$products->marca}} ' - ' {{$products->modelo}}' - ' {{$products->rodada}}</p>
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Observaciones:</strong>{{$products->observaciones}}</p>
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Precio del servicio:</strong>{{$products->precio_servicio}}</p>
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Saldo a favor:</strong>${{$products->subtoral}}.0</p>
                        <p class="respuesta_qr_info"><strong class="strong_qr_res">Total:</strong>${{$products->total}}.0</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_service{{$products->id}}">Editar</button>
                        </div>
                    </div>
                    <div class="modal fade" id="edit_modal_service{{$products->id}}" tabindex="-1" aria-labelledby="edit_modal_service{{$products->id}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">$products->Cliente->nombre</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row" method="POST" action="{{route('scanner_servicio.edit', $products->id)}}" >
                                <input type="hidden" name="_token" value="csrf_token()">
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="col-12">
                                    {{-- <p class="text-center">
                                    <img src="{{asset('fotos_bicis/'.$products->foto1)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="{{asset('fotos_bicis/'.$products->foto2)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="{{asset('fotos_bicis/'.$products->foto3)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="{{asset('fotos_bicis/'.$products->foto4)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;">
                                    </p> --}}
                                </div>
                                <div class="col-12">
                                <label for="name" class="form-label">Estatus</label>
                                <select class="form-select" name="estado">
                                    <option selected >$products->estatus</option>
                                    <option value="1">Procesando</option>
                                    <option value="2">En Espera</option>
                                    <option value="3">Realizado</option>
                                    <option value="4">Cancelado</option>
                                    <option value="0">R ingresado</option>
                                    <option value="5">Pagado</option>
                                </select>
                                </div>
                                <div class="col-4">
                                <label for="price" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca" value="{{$products->marca}}">
                                </div>
                                <div class="col-4">
                                <label for="sale_price" class="form-label">Modelo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" value="{{$products->modelo}}">
                                </div>
                                <div class="col-4">
                                <label for="sku" class="form-label">Rodada</label>
                                <input type="text" class="form-control" id="rodada" name="rodada" value="{{$products->rodada}}">
                                </div>
                                <div class="col-4">
                                <label for="Costo del servicio" class="form-label">Precio del servicio</label>
                                <input type="number" class="form-control" id="precio_servicio" name="precio_servicio" value="{{$products->precio_servicio}}">
                                </div>
                                <div class="col-4">
                                <label for="Saldo a Favor" class="form-label">Saldo a Favor</label>
                                <input type="number" disabled class="form-control" id="subtotal" name="subtotal" value="{{$products->subtotal}}">
                                </div>
                                <div class="col-4">
                                <label for="Total" class="form-label">Total</label>
                                <input type="number" class="form-control" id="total" name="total" value="{{$products->total}}">
                                </div>
                                <button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>
                                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>
                            </form>
                            <form method="POST" id="miFormulario" action="{{route('product.store_product', $products->id)}}" enctype="multipart/form-data" role="form">
                            <input type="hidden" name="_token" value="csrf_token()">
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="id" id="id" value="{{$products->id}}">
                            <input type="hidden" name="folio" id="folio" value="{{$products->folio}}">
                            <div class="row">
                                <div class="col-12">
                                    <label class="text-dark" for="">Ingresa el o los productos para el servicio</label><br>
                                    <label class="text-dark">Medio Servicio : 23431 <br>Servicio Completo : 61534 <br>Nivelada : 19328 <br>Parche : 29117 <br>Ajuste/Camio de frenos : 29548 <br></label>
                                </div>
                                <div class="col-9">
                                    <label class="text-dark" for="">Sku</label><br>
                                    <input class="form-control" type="number" name="sku" id="sku" placeholder="1234">
                                </div>
                                <div class="col-3">
                                    <label class="text-dark" for="">Cantidad</label><br>
                                    <input class="form-control" type="number" name="cantidad" id="cantidad" value="1">
                                </div>
                                <div class="col-12">
                                    <button type="submit" id="submitBtn" class="ladda-button btn btn-success mt-3" data-style="expand-right" style=" color: #ffff;width:100%;">
                                        <span class="ladda-label">Cargar prodcuto</span>.
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                @endisset
            </div>
        </div>
        <div class="col-12">
            <div class="container_request_qr"></div>
            {{-- <button id="resetScannerBtn" class="btn btn-primary">Resetear Scanner</button> --}}
            <button id="resetScannerBtn" class="btn btn-danger no_aparece mt-3">Reiniciar escáner</button>
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
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
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
<link rel="stylesheet" href="{{ asset('assets/admin/css/servicios.css')}}">
{{-- <script src="{{ asset('assets/admin/js/ht.js')}}"></script> --}}
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

{{-- <script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script type = "text/javascript">

$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });


let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  { facingMode: "environment" },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);

function onScanSuccess(result, decodedResult) {
    html5QrcodeScanner.clear().then(_ => {

        $.ajax({
                type: 'get',
                url: '{{ route('scanner.search') }}',
                data: { 'search': result },
                success: function (data) {
                    console.log('Data from AJAX:', data);
                    $('#servicio-data').html(data); // Actualiza la sección con los datos del servicio
                }
            });
            console.log(`folio_bici: = ${result}`);
            document.getElementById('resetScannerBtn').classList.remove('no_aparece');
            document.getElementById('result').innerHTML = `
            <div class="d-flex justify-content-start">
                <h2 style="font-size: 20px;">Escaneo Exitoso!</h2>
                <p style="margin-left: 2rem;font-size: 20px;">${result}</p>
            </div>`;
            const audio = new Audio("{{ asset('assets/admin/img/barras.mp3')}}");
            audio.play();
            scanner.clear();
            // Clears scanning instance
            document.getElementById('reader').remove();
            // Removes reader element from DOM since no longer needed

        console.log(`clear = ${result}`);

    }).catch(error => {
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
//   document.getElementById('resetScannerBtn').style.display = 'none';
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
