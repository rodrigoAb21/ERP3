<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> VENTAS</title>
    <style>
        body{
            padding-top: 15px;
        }
        table{
            width: 100%;
        }

        th, td {
            padding: 5px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #8b8d88;
            color: white;
        }
        table {
            border-spacing: 5px;
        }
    </style>
</head>
<body style="font-family: sans-serif";>
    <h1 align="center">Ventas del mes</h1>
    <div>
        <table >
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio Unitario Venta</th>
                <th>Ganancia</th>
                <th>Ganancia Neta</th>
            </tr>
            </thead>
            @foreach ($mV as $masV)
                <tr>
                    <td>{{ $masV->id}}</td>
                    <td>{{ $masV->nombre }}</td>
                    <td>{{ $masV->cantidad}}</td>
                    <td>{{ $masV->precioV}}</td>
                    <td>{{ $masV->ganancia}}</td>
                    <td>{{ $masV->ganancia_neta}}</td>
                </tr>
            @endforeach

        </table>
    </div>
</body>
</html>