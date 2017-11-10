@extends ('admin')
@section ('contenido')
    <a href="{{ url('admin/seguimientos') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</a>
    <h2>Seguimientos al Cliente <b style="color: darkslateblue">{{$cliente->nombre}}</b></h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Proposito</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($seguimientos as $seguimiento)
        <tr>
            <td>{{$seguimiento->id}}</td>
            <td>{{$seguimiento->fechaInicio}}</td>
            <td>{{$seguimiento->proposito}}</td>
            <td>
                <div style="background-color: {{$seguimiento->estado->color}};padding:4px;color: white">
                    <b>{{$seguimiento->estado->nombre}}</b>
                </div>
            </td>
            <td>
                <a href="{{url('admin/asignacion/'.$seguimiento->id)}}"
                   class="btn btn-sm btn-default">ver Tareas</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection