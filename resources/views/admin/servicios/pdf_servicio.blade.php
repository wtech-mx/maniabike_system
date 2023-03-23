<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Document</title>
    </head>
    <body>
        <div class="" style="position: absolute;top:-35px;left:-28px;padding:0">{!! DNS1D::getBarcodeHTML($taller->folio, 'UPCA') !!}</div>
        <p style="font-size: 14px;padding:0;position: absolute;top:-15px;left:-30px;">Folio:{{$taller->folio}} <br> Cliente:{{$cliente->nombre}} <br> Telefono: {{$cliente->telefono}}</p>
    </body>
</html>
