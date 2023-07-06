<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        header, footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #004d7a;
            color: #ffffff;
        }

        header table, footer table {
            width: 50%;
        }

        header table td, footer table td {
            padding: 0;
            border: none;
            vertical-align: middle;
        }

        header img, footer img {
            width: 100px;
            padding: 0 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #004d7a;
        }

        img {
            width: 140px;
            border-radius: 16px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <table>
            <tr>
                <td>
                    <img src="https://scontent.fmex28-1.fna.fbcdn.net/v/t39.30808-1/270423810_1957165624443123_3118909372186457774_n.png?stp=dst-png_p320x320&_nc_cat=107&cb=99be929b-3346023f&ccb=1-7&_nc_sid=c6021c&_nc_eui2=AeEq-_E2_BPGWHpdBOmu_cJ3vgYiDdkWP32-BiIN2RY_fQS0nBp0Ti0tVOuWt_hVM05Q5gKBsRSjTgntsM7oj2P-&_nc_ohc=zrBtm5FGDOgAX8BWwqM&_nc_ht=scontent.fmex28-1.fna&oh=00_AfDcPrCBVhGlaxX8TbohV9MSNuI6DN_LuxiDET4vKRd5kQ&oe=64ABE0F2" alt="Logo">
                </td>
                <td>
                    <p style="color: #004d7a">---------------------------------------</p>
                </td>
                <td style="width: 350px">
                    <h1>- Maniabike Boutique</h1>
                    <h5 style="text-align:left">Mayoristas</h5>
                    <ul style="list-style: none;text-align:left">
                        <li><strong>Telefono:</strong> 5519637033</li>
                        <li><strong>Dirección:</strong> Cto. Interior 888, Insurgentes Mixcoac, Benito Juárez, 03920, CDMX </li>
                        <li><strong>Horario: </strong>  L a V  10:00 AM a 6:00 PM, Sabado :10:00 AM a 3:00 PM</li>
                    </ul>
                </td>
            </tr>
        </table>
    </header>
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
                $clave_mayorista = null;

                $letraNumeroMapa = array(
                                'M' => 1,
                                'A' => 2,
                                'R' => 3,
                                'Q' => 4,
                                'U' => 5,
                                'E' => 6,
                                'S' => 7,
                                'I' => 8,
                                'T' => 9,
                                'O' => 0
                            );

                            $numero = '';

                            foreach ($producto['meta_data'] as $item) {
                                if ($item->key === 'clave_mayorista') {
                                    $clave_mayorista = $item->value;
                                    break;
                                }
                            }
                            $letras = str_split($clave_mayorista);


                            foreach ($letras as $letra) {
                                if (isset($letraNumeroMapa[$letra])) {
                                    $numero .= $letraNumeroMapa[$letra];
                                }
                            }

                            $priceFormatted = '$ ' . number_format($numero, 2);

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
    <footer>
        <table>
            <tr>
                <td>
                    <img src="https://scontent.fmex28-1.fna.fbcdn.net/v/t39.30808-1/270423810_1957165624443123_3118909372186457774_n.png?stp=dst-png_p320x320&_nc_cat=107&cb=99be929b-3346023f&ccb=1-7&_nc_sid=c6021c&_nc_eui2=AeEq-_E2_BPGWHpdBOmu_cJ3vgYiDdkWP32-BiIN2RY_fQS0nBp0Ti0tVOuWt_hVM05Q5gKBsRSjTgntsM7oj2P-&_nc_ohc=zrBtm5FGDOgAX8BWwqM&_nc_ht=scontent.fmex28-1.fna&oh=00_AfDcPrCBVhGlaxX8TbohV9MSNuI6DN_LuxiDET4vKRd5kQ&oe=64ABE0F2" alt="Logo">
                </td>
                <td>
                    <p style="color: #004d7a">---------------------------------------</p>
                </td>
                <td style="width: 350px">
                    <ul style="list-style: none;text-align:left">
                        <li>
                            <strong>Nota:</strong><br>
                            <p>Precio de productos hasta agotar existencia.
                                Si quieres mas informacion y/o ver el STOCK disponible ingresa a :
                                <a href="https://www.maniabikes.com.mx/inicio/">https://www.maniabikes.com.mx/inicio/</a> <br> e ingresa el SKU deseado.
                            </p>
                        </li>
                    </ul>
                </td>
            </tr>
        </table>
    </footer>
</body>
</html>
