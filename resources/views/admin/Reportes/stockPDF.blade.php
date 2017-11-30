<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Lista de Productos </title>
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
<h2 align="center">Lista Productos del Punto: {{$punto -> nombre}}</h2>
<div>
    <table >
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Stock Minimo</th>
            <th>Stock Actual</th>
        </tr>
        </thead>
        @foreach ($stock as $masV)
            <tr>
                <td>{{ $masV->id}}</td>
                <td>{{ $masV->nombre }}</td>
                <td>{{ $masV->minimo}}</td>
                <td>{{ $masV->actual}}</td>
            </tr>
        @endforeach

    </table>
</div>
</body>
</html>