@extends ('admin')
@section ('contenido')
    <div class="col-sm-12">


        <h3>Busqueda por Nombre de CU o por Departamento</h3>

        <form method="post" class="form-inline well" action="{{url('/admin/casouso/buscar')}}">

            <br>
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text"
                       @if($casousoSearch=='')
                       placeholder="nombre de cu..."
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
@endsection
