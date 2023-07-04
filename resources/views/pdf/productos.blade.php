<!DOCTYPE html>
<html>
<head>
    <title>Productos PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Productos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->sku }}</td>
                <td>{{ $producto->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
