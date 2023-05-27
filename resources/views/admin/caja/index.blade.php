@extends('layouts.app_admin')

@section('template_title')
    Caja
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/scanner.css')}}">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 mt-2 mb-2" style="background: #fff;border-radius: 18px;">
            <div class="d-flex justify-content-around align-items-center">
                <div class="contenedor">
                    Logo
                </div>

                <div class="contenedor mt-2 mb-2">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                            Scanner
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                            Manual
                          </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="content_qr">
                                <div id="reader"></div>
                                <div id="result"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                            Contenido Manual
                        </div>
                    </div>
                </div>

                <div class="contenedor">
                    <a href="#">
                        <img class="" src="{{ asset('assets/admin/img/icons/plus.png') }}" alt="" style="width: 30px">
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12" style="background: #fff;border-radius: 18px;padding: 15px;">
            <div class="d-flex justify-content-start">
                Buscador de usuario
            </div>
        </div>
    </div>

</div>

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

            console.log(`folio_bici: = ${result}`);
            document.getElementById('resetScannerBtn').classList.remove('no_aparece');
            document.getElementById('result').innerHTML = `
            <div class="d-flex justify-content-start">
                <h2 style="font-size: 20px;">Escaneo Exitoso!</h2>
                <p style="margin-left: 2rem;font-size: 20px;">${result}</p>
            </div>`;
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

