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

    $price = $products['price'];
    $formattedPrice = '$' . number_format($price, 2, '.', ',');

@endphp
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Document</title>
    </head>
    <body>
        <div class="" style="position: absolute;padding:0;">
            <div style="position: relative;top:-35px;left:-37px;">
                {!! DNS1D::getBarcodeHTML($products['sku'], 'C128',2,25) !!}
                <p style="font-size: 9px;padding:1px;margin:0px;">{{ Str::limit($products['name'], 75) }}</p>
                <p style="font-size: 9px;padding:1px;margin:0px;">{{ $products['sku']}}</p>
                <p style="font-size: 9px;padding:1px;margin:0px;">{{ $formattedPrice}} / {{ $clave_mayorista}}</p>
            </div>
        </div>

    </body>
</html>
