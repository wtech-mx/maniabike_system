@extends('layouts.app_admin')

@section('template_title')
   Qr Scanner
@endsection

@section('css')
<style>
    main {
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
<section class="" style="min-height: 800px;padding: 15px;">

    <main>
        <div id="reader"></div>
        <div id="result"></div>
    </main>

</section>

@endsection

@section('columna_4')
    <p class="text-center">
        <a class="btn_back" href="{{ route('taller.create') }}"">
            <i class="fas fa-plus-circle"></i>
        </a>
    </p>
@endsection

@section('select2')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    const scanner = new Html5QrcodeScanner('reader', {
        // Scanner will be initialized in DOM inside element with id of 'reader'
        qrbox: {
            width: 250,
            height: 250,
        },  // Sets dimensions of scanning box (set relative to reader element width)
        fps: 20, // Frames per second to attempt a scan
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

    }

    function error(err) {
        console.error(err);
        // Prints any errors to the console
    }

</script>
@endsection