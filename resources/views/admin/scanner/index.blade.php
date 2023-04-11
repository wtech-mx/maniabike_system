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
        <h1 class="text-white text-center">¡Scanner!</h1>
        <div class="col-12" style="padding: 0!important;">
            <div class="d-flex justify-content-center mt-5">

                <a class="btn_servicio" href="#">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lupa_list.png') }}" alt="">
                    <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Servicio</p>
                </a>

                <a class="btn_servicio_p" href="{{ route('scanner_products.index') }}">
                    <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lupa_list.png') }}" alt="">
                    <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Productos</p>
                </a>

            </div>
        </div>
        <div class="col-12">
            <div class="content_qr">
                <div id="reader"></div>
                <div id="result"></div>
            </div>
            <div class="container_request_qr"></div>
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

// scanner folio bicic

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

        document.getElementById('result').innerHTML = `
        <h2>Success!</h2>
        <p><a href="${result}">${result}</a></p>
        `;
        // Prints result as a link inside result element
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

    </script>
@endsection
