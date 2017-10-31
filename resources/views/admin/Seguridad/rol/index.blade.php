@extends ('admin')
@section ('contenido')
                            <form method="post" class="form-inline well" action="{{url('/admin/rol/buscar')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="depto">Busqueda por Rol:</label>
                    <select name="depto" class="btn-lg btn-primary">
                        @foreach($roles as $rol)
                            <option value="{{$rol->id}}"
                            @if($rolSearch->id==$rol->id) selected @endif
                            >{{$rol->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-info">Buscar</button>
                </div>
            </form>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Caso de uso</th>
                    <th>Leer</th>
                    <th>Crear</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Opcion</th>
                </tr>
                </thead>
                <tbody>

                @foreach($rolSearch->casousos as $cu)
                    <tr>
                        <td>{{$cu->id}}</td>
                        <td>{{$cu->nombre}}({{$cu->depto->nombre}})</td>
                        <td><input type="checkbox" @if($cu->pivot->leer==1) checked @endif></td>
                        <td><input type="checkbox" @if($cu->pivot->crear==1) checked @endif></td>
                        <td><input type="checkbox" @if($cu->pivot->editar==1) checked @endif></td>
                        <td><input type="checkbox" @if($cu->pivot->eliminar==1) checked @endif></td>
                        <td><a href="{{url('/admin/acciones/'.$cu->id.'/'.$rolSearch->id)}}"
                               class="btn btn-warning">Editar Acciones</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


@endsection