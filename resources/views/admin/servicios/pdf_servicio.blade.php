<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Document</title>
    </head>
    <body>
        <div class="" style="position: absolute;top:-35px;left:-30px;padding:0;">
            {!! DNS1D::getBarcodeHTML($taller->folio, 'C128',3,35) !!}
        </div>
        <p style="font-size: 14px;padding:0;position: absolute;top:-15px;left:-30px;">Folio:{{$taller->folio}} / Tel: {{$cliente->telefono}} <br> Cliente:{{$cliente->nombre}} <br> </p>
    </body>
</html>
