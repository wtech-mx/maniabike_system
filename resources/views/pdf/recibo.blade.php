<?php
$medidaTicket = 180;
?>
<!DOCTYPE html>
<html>

<head>

    <style>
        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.precio {
            text-align: right;
            font-size: 9px;
        }

        td.cantidad {
            font-size: 9px;
        }

        td.producto {
            text-align: center;
        }

        th {
            text-align: center;
        }


        .centrado {
            text-align: center;
            align-content: center;
        }

        .left {
            text-align: left;
            align-content: left;
        }

        .ticket {
            width: {{ $medidaTicket }}px;
            max-width: {{ $medidaTicket }}px;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .ticket {
            margin: 0;
            padding: 0;
        }

        body {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="ticket left" style="padding: 15px">
        <h3>ManiaBike</h3> <br>
        <h5>Ticket #{{ $notas->id }}</h5>
        <h5>{{ $notas->fecha }}</h5><br>
        @foreach ($notas_productos as $notas_producto)
        <p style="font-size: 13px">
            <strong>Nombre:   </strong> <br>  {{ $notas_producto->name }} <br> <br>
            <strong>Precio:   </strong> <br>  ${{ $notas_producto->precio }}.0 <br> <br>
            <strong>Cantidad: </strong> <br>    {{ $notas_producto->cantidad }} <br> <br>
            <strong>Subtotal: </strong> <br>  {{ $notas_producto->subtotal }} <br> <br>
            <strong> ------------------------------------------- </strong>
        </p>
        @endforeach

        <p style="font-size: 16px">
            <strong>Total: </strong> <br>  ${{ $notas->total }}.0 <br> <br>
        </p>

        <p class="centrado" style="font-size: 15px"><br>¡GRACIAS POR SU COMPRA! <br> <br> maniabikes.com.mx</p>
    </div>
</body>

</html>
