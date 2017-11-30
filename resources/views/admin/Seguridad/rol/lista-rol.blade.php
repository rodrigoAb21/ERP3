@extends ('admin')
@section ('contenido')
    <div class="row">
    <div class="col-sm-10">
        <h3>Roles de Usuario del Sistema</h3>


    </div>
    <div class="col-sm-2">
        <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                data-target="#myModal">Crear Rol</button>
    </div> <table class="table table-hover">
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
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form action="{{url('/admin/rol/guardar')}}" method="POST">{{ csrf_field() }}
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Crear Rol</h4>
                </div>
                <div class="modal-body">

                        <input class="form-control" name="nombre" type="text" placeholder="Nombre de Rol...">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" >Crear</button>

                </div>
            </div>
            </form>

        </div>
    </div>
@endsection
