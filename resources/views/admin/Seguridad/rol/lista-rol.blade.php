@extends ('admin')
@section ('contenido')
    <div class="col-sm-10">
        
            <h3>Roles de Usuario del Sistema</h3>
         <table class="table table-hover">
                <thead>
                <tr>
                    <th>Nombre del Rol</th>
                    <th>Opcion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $rol)
                    <tr>
                        <td>{{$rol->nombre}}</td>
                        <td><a href="{{url('/admin/rol/actualizar-cu/'.$rol->id)}}"
                               class="btn btn-sm btn-default">Editar Casos de Uso</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
