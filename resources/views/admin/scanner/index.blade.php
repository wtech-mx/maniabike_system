@extends('layouts.app_admin')

@section('template_title')
   Crear Servicio
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
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="--bs-nav-tabs-border-width: 0px!important;">
                      <button class="nav-link active" id="nav-detalles-tab" data-bs-toggle="tab" data-bs-target="#nav-detalles" type="button" role="tab" aria-controls="nav-detalles" aria-selected="true">
                        <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lupa_list.png') }}" alt="">
                        <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Servicio</p>
                      </button>

                      <button class="nav-link" id="nav-producto-tab" data-bs-toggle="tab" data-bs-target="#nav-producto" type="button" role="tab" aria-controls="nav-producto" aria-selected="false">
                        <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/manivela.png') }}" alt="">
                        <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Productos</p>
                      </button>

                    </div>
                  </nav>
                </div>
            </div>

        <div class="col 12">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-detalles" role="tabpanel" aria-labelledby="nav-detalles-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12">
                            <div class="content_qr">
                                <div id="reader"></div>
                                <div id="result"></div>
                            </div>
                            <div class="container_request_qr"></div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show " id="nav-producto" role="tabpanel" aria-labelledby="nav-producto-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12">
                            <div class="content_qr2">
                                <div id="reader_product"></div>
                                <div id="result_product"></div>
                            </div>
                            <div class="container_request_qr_product"></div>
                        </div>
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

// scanner productos

let html5QrcodeScannerProduct = new Html5QrcodeScanner(
  "reader_product",
  { fps: 10, qrbox: {width: 250, height: 250} },
  { facingMode: "environment" },
  /* verbose= */ false);
html5QrcodeScannerProduct.render(onScanSuccessProduct, onScanFailure);

function onScanSuccessProduct(result) {
    html5QrcodeScannerProduct.clear().then(_ => {

        $.ajax({
            type : 'get',
            url : '{{ route('scanner_product.search') }}',
            data:{'search':result},
                success:function(data){
                    $('.container_request_qr_product').html(data);
                }
            });

            console.log(`producto_sku: = ${result}`);

        document.getElementById('result_product').innerHTML = `
        <h2>Success!</h2>
        <p><a href="${result}">${result}</a></p>
        `;
        // Prints result as a link inside result element
        scanner.clear();
        // Clears scanning instance
        document.getElementById('reader_product').remove();
        // Removes reader element from DOM since no longer needed

        console.log(`clear = ${result}`);

    }).catch(error => {
  });
}
    // const scanner = new Html5QrcodeScanner('reader', {
    //     formatsToSupport: [ Html5QrcodeSupportedFormats.C128 ],

    //     // Scanner will be initialized in DOM inside element with id of 'reader'
    //     qrbox: {
    //         width: 250,
    //         height: 250,
    //     },  // Sets dimensions of scanning box (set relative to reader element width)
    //     fps: 30, // Frames per second to attempt a scan
    // });

    // scanner.render(success);
    // // Starts scanner

    // const scanner_product = new Html5QrcodeScanner('reader_product', {
    //     formatsToSupport: [ Html5QrcodeSupportedFormats.C128 ],
    //     // Scanner will be initialized in DOM inside element with id of 'reader'
    //     qrbox: {
    //         width: 250,
    //         height: 250,
    //     },  // Sets dimensions of scanning box (set relative to reader element width)
    //     fps: 30, // Frames per second to attempt a scan
    // });

    // scanner_product.render(success);
    // // Starts scanner

    // function success(result) {

    //         $.ajax({
    //         type : 'get',
    //         url : '{{ route('scanner.search') }}',
    //         data:{'search':result},
    //             success:function(data){
    //                 $('.container_request_qr').html(data);
    //             }
    //         });

    //     console.log('bici');

    //     document.getElementById('result').innerHTML = `
    //     <h2>Success!</h2>
    //     <p><a href="${result}">${result}</a></p>
    //     `;
    //     // Prints result as a link inside result element
    //     scanner.clear();
    //     // Clears scanning instance
    //     document.getElementById('reader').remove();
    //     // Removes reader element from DOM since no longer needed

    //     console.log(`Scan result: ${result}`);

    //     Html5QrcodeScanner.clear();
    // }


    // function success(result) {

    //         $.ajax({
    //         type : 'get',
    //         url : '{{ route('scanner_product.search') }}',
    //         data:{'search':result},
    //             success:function(data){
    //                 $('.container_request_qr_product').html(data);
    //             }
    //         });
    //     console.log('producto');

    //     document.getElementById('result').innerHTML = `
    //     <h2>Success!</h2>
    //     <p><a href="${result}">${result}</a></p>
    //     `;
    //     // Prints result as a link inside result element
    //     scanner_product.clear();
    //     // Clears scanning instance
    //     document.getElementById('result').remove();
    //     // Removes reader element from DOM since no longer needed

    //     console.log(`Scan result: ${result}`);

    //     Html5QrcodeScanner.clear();
    // }

    // function error(err) {
    //     console.error(err);
    //     // Prints any errors to the console
    // }

    </script>
@endsection
