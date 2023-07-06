<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #80CED7;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #80CED7;
        }

        img {
            width: 140px;
            border-radius: 16px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <h1>Productos</h1>
    <table>
        <thead>
            <tr>
                <th>Img</th>
                <th>SKU</th>
                <th>Nombre</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            @php
                $imageSrc = $producto['images'][0]->src;
                $priceFormatted = '$ ' . number_format($producto['price'], 2);
            @endphp
            <tr>
                <td>
                    <a href='{{ $producto['permalink'] }}' target="_blank">
                        <img src='{{$imageSrc}}'>
                    </a>
                </td>
                <td>{{ $producto['sku'] }}</td>
                <td>{{ $producto['name'] }}</td>
                <td>{{ $priceFormatted }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
