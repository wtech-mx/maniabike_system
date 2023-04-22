<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Document</title>
    </head>
    <body>
        <div class="" style="position: absolute;top:-32px;left:-40px;padding:0;">
            {!! DNS1D::getBarcodeHTML($taller->folio, 'C128',2.5,30) !!}
        </div>
        <p style="font-size: 13px;padding:0;position: absolute;top:-12px;left:-40px;display: inline-block;">#:{{$taller->folio}} /{{$taller->marca}} / Tel: {{$cliente->telefono}} <br> Cliente:{{$cliente->nombre}} <br> </p>
    </body>
</html>
