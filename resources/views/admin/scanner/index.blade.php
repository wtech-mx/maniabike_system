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
            <div id="result" style="background: #80CED7;padding: 10px; border-radius: 19px 19px 0px 0px ;color:#000">
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
            type : 'get',
            url : '{{ route('scanner.search') }}',
            data:{'search':result},
                success:function(data){
                    $('.container_request_qr').html(data);
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
