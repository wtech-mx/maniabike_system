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
        <div class="" style="position: absolute;top:-30px;left:-40px;padding:0;">
            {!! DNS1D::getBarcodeHTML($products['sku'], 'C128',2.5,30) !!}
        </div>
        <p style="font-size: 11px;padding:0;position: absolute;top:-10px;left:-45px;display: inline-block;">
            {{ Str::limit($products['name'], 25) }}<br>
            {{ $products['sku']}} <br>
            {{ $clave_mayorista}}  <br>
        </p>
    </body>
</html>
