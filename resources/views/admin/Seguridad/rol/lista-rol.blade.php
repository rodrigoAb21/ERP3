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
        {{ $roles->links() }}
        </div>
    </div>


    <!-- Modal crear Rol -->
    <div id="crearRol" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form method="POST" action="{{url('/admin/rol/guardar')}}">
            {{ csrf_field() }}
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nuevo Rol</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
