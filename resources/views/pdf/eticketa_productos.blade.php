<!DOCTYPE html>
{{-- Importa el helper Str --}}
@php
    use Illuminate\Support\Str;
    $clave_mayorista = null;
    foreach ($products['meta_data'] as $item) {
                if ($item->key === 'clave_mayorista') {
                    $clave_mayorista = $item->value;
                    break;
                }
            }
@endphp
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Document</title>
    </head>
    <body>
        <div class="" style="position: absolute;top:-30px;left:-42px;padding:0;">
            {!! DNS1D::getBarcodeHTML($products['sku'], 'C128',2.5,30) !!}
        </div>
        <p style="font-size: 10px;padding:0;position: absolute;top:-10px;left:-39px;display: inline-block;">
            <strong>{{ Str::limit($products['name'], 25) }}</strong><br>
            <strong>{{ $products['sku']}}</strong> <br>
            <strong>{{ $clave_mayorista}}</strong>  <br>
        </p>
    </body>
</html>
