<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Document</title>
    </head>
    <body>
        <div class="" style="position: absolute;top:-30px;left:-42px;padding:0;">
            {!! DNS1D::getBarcodeHTML($products['sku'], 'C128',2.5,30) !!}
        </div>
        <p style="font-size: 12px;padding:0;position: absolute;top:-10px;left:-42px;display: inline-block;">
            {{ $products['name']}}<br>
            {{ $products['sku']}} <br>
            MQ <br>
        </p>
    </body>
</html>
