@extends('layouts.app_admin')

@section('template_title')
   Crear Servicio
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/servicios.css')}}">
<style>
    .table td, .table th {
    white-space: revert!important;
    }

    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 0px solid transparent !important;
    border-radius: 0px!important;
    padding: 22px;
}

    .select2 {
        width: 380px!important;
    }

    .content_qr{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #reader {
        width: 400px;
    }

    #result {
        text-align: center;
        font-size: 1.5rem;
    }

</style>
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
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show " id="nav-producto" role="tabpanel" aria-labelledby="nav-producto-tab" tabindex="0">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="product_id" id="product_id">
                         <div class="form-group">
                             <label for="name" class="col-sm-2 control-label">Name</label>
                             <div class="col-sm-12">
                                 <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                             </div>
                         </div>
                         <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                          </button>
                         </div>
                     </form>
                </div>
            </div>
        </div>

    </div>

</section>

@endsection



@section('select2')

{{-- <script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <script type = "text/javascript">

$(function () {

      /*------------------------------------------
       --------------------------------------------
       Pass Header Token
       --------------------------------------------
       --------------------------------------------*/
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      /*------------------------------------------
      --------------------------------------------
      Click to Button
      --------------------------------------------
      --------------------------------------------*/
      $('#createNewProduct').click(function () {
          $('#saveBtn').val("create-product");
          $('#product_id').val('');
          $('#productForm').trigger("reset");
          $('#modelHeading').html("Create New Product");
          $('#ajaxModel').modal('show');
      });

      /*------------------------------------------
      --------------------------------------------
      Create Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('#saveBtn').click(function (e) {
          e.preventDefault();
          $(this).html('Sending..');

          $.ajax({
            data: $('#productForm').serialize(),
            url: "{{ route('scanner.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#productForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();

            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
      });

    });

    const scanner = new Html5QrcodeScanner('reader', {
        formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ],
        // Scanner will be initialized in DOM inside element with id of 'reader'
        qrbox: {
            width: 250,
            height: 250,
        },  // Sets dimensions of scanning box (set relative to reader element width)
        fps: 30, // Frames per second to attempt a scan
    });

    scanner.render(success, error);
    // Starts scanner

    function success(result) {

        document.getElementById('result').innerHTML = `
        <h2>Success!</h2>
        <p><a href="${result}">${result}</a></p>
        `;
        // Prints result as a link inside result element
        scanner.clear();
        // Clears scanning instance
        document.getElementById('reader').remove();
        // Removes reader element from DOM since no longer needed

        console.log(`Scan result: ${result}`);

        Html5QrcodeScanner.clear();
    }

    function error(err) {
        console.error(err);
        // Prints any errors to the console
    }

    </script>
@endsection
