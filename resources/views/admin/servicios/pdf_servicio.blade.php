<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Document</title>
    </head>
    <body>
        <div class="contenido">
            <p style="font-size: 10px">{{$taller->folio}}</p>
            <div class="">{!! DNS1D::getBarcodeHTML($taller->folio, 'UPCA') !!}</div>
            <p style="font-size: 10px">{{$cliente->nombre}} - {{$cliente->telefono}}</p>
        </div>
    </body>
</html>
