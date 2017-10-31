@extends ('admin')
@section ('contenido')
    @include('flash::message')
    <div class="row">
        <div class="col-sm-10"><h2>Seguimientos a Clientes</h2></div>
        <div class="col-sm-2">
            <br><br>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalCreate">
                Nuevo +
            </button>
        </div>
    </div>
    <br>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>TipoCliente</th>
            <th>Nº de Seguimientos </th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($seguimientos as $item)
            <tr>
                <td>{{$item->cliente_nombre}}</td>
                <td>{{$item->cliente_tipo}}</td>
                <td>{{$item->count}}</td>
                <td>
                    <a href="{{url('admin/seguimientos/cliente/'.$item->cliente_id)}}"
                       class="btn btn-default">
                        ver Seguimientos</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('admin.CRM.seguimientos.create')

@endsection