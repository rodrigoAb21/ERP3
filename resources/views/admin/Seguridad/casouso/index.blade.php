@extends ('admin')
@section ('contenido')
    <div class="col-sm-10">


        <h2>Lista de Casos de Uso </h2>

        <form method="post" class="form-inline well" action="{{url('/admin/casouso/buscar')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text"
                       @if($casousoSearch=='')
                       placeholder="empleado..."
                       @else
                       value="{{$casousoSearch}}"
                       @endif
                       class="form-control" name="casouso">
            </div>
            <div class="form-group">
                <label for="depto">Departamento:</label>
                <select name="depto">
                    <option value="0">--Todos--</option>
                    @foreach($deptos as $depto)
                        <option value="{{$depto->id}}"
                                @if($deptoSeach==$depto->id) selected @endif
                        >{{$depto->nombre}}</option>
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
                <th>Nro</th>
                <th>Caso de uso</th>
                <th>Departamento</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cus as $cu)
                <tr>

                    <td>{{$cu->id}}</td>
                    <td>{{$cu->nombre}}</td>
                    <td>{{$cu->depto->nombre}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-2">
        <br><br>
        <button class="btn btn-lg btn-primary" data-toggle="modal"
                data-target="#crearCU">Crear CU
        </button>
    </div>


    </div>

    <!-- Modal crearCU -->
    <div id="crearCU" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form method="POST" action="{{url('/admin/casouso/guardar')}}">
            {{ csrf_field() }}
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Crear Nuevo Caso de Uso</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre">
                        </div>
                        <div class="form-group">
                            <select name="depto">
                                <option value="0">Seleccione un Departamento</option>
                                @foreach($deptos as $depto)
                                    <option value="{{$depto->id}}">{{$depto->nombre}}</option>
                                @endforeach
                            </select>
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