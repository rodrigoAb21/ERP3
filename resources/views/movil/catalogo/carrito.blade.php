@extends('movil')
@section('contenido')


    <h2>Carrito</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Estado</th>

        </tr>
        </thead>
        <tbody>
        @foreach($productos as $producto)

         <tr>
            <td>{{$producto->nombre}}</td>
            <td>@if($producto->pivot->pagado)
                    PAGADO(PUNTOS)
                    @else
                    RESERVADO
                    @endif
                </td>
        </tr>
       @endforeach
        </tbody>
    </table>
    <a href="{{url('movil/carrito/finalizar')}}" class="btn btn-primary btn-lg">Finalizar</a>
@endsection