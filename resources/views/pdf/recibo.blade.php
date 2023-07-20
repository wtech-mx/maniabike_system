<?php
$medidaTicket = 180;

?>
<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

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
            font-size: 11px;
        }

        td.cantidad {
            font-size: 11px;
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

        .ticket {
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
        }

        img {
            max-width: inherit;
            width: inherit;
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
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="ticket centrado">
        <h1>NOMBRE DEL NEGOCIO</h1>
        <h2>Ticket de venta #12</h2>
        <h2>{{ $notas->fecha }}</h2>
        <?php
        # Recuerda que este arreglo puede venir de cualquier lugar; aquí lo defino manualmente para simplificar
        # Puedes obtenerlo de una base de datos, por ejemplo: https://parzibyte.me/blog/2019/07/17/php-bases-de-datos-ejemplos-tutoriales-conexion/

        $productos = [
            [
                "cantidad" => 31,
                "descripcion" => "Cheetos verdes 80 g",
                "precio" => 123,
            ],
            [
                "cantidad" => 12,
                "descripcion" => "Teclado HyperX",
                "precio" => 1233,
            ],
            [
                "cantidad" => 12,
                "descripcion" => "Mouse Logitech ASD123",
                "precio" => 841,
            ],
            [
                "cantidad" => 15,
                "descripcion" => "Monitor Samsung 123",
                "precio" => 3546,
            ],
        ];
        ?>

        <table>
            <thead>
                <tr class="centrado">
                    <th class="cantidad">Nombre</th>
                    <th class="producto">Precio</th>
                    <th class="precio">Cantidad</th>
                    <th class="precio">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($notas_productos as $notas_producto) {
                ?>
                    <tr>
                        <td class="cantidad">{{ $notas_producto->name }}</td>
                        <td class="producto">{{ $notas_producto->precio }}</td>
                        <td class="precio">{{ $notas_producto->cantidad }}</td>
                        <td class="precio">{{ $notas_producto->subtotal }}</td>
                    </tr>
                <?php } ?>
            </tbody>
            <tr>
                <td class="cantidad"></td>
                <td class="producto">
                    <strong>TOTAL</strong>
                </td>
                <td class="precio">
                    $<?php echo number_format($total, 2) ?>
                </td>
            </tr>
        </table>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
            <br>parzibyte.me</p>
    </div>
</body>

</html>
