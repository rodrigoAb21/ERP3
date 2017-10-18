@extends ('admin')
@section ('contenido')
    <div class="col-sm-10">
        <div class="col-sm-6 well">
            <form method="post" class="form-inline " action="{{url('/admin/rol/remover-cu')}}">
                <div class="row">
                    <div class="col-sm-9">
                        <h3>Caso de Uso Asignados</h3>
                    </div>
                    <div class="col-sm-2"><br><br>
                        <button class="btn btn-danger">Remover</button>
                    </div>
                </div>
                {{ csrf_field() }}
                <input type="hidden" value="{{$rol->id}}" name="rol">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Caso de uso</th>
                        <th>Opcion</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($rol->casousos as $cu)
                        <tr>
                            <td>{{$cu->nombre}}({{$cu->depto->nombre}})</td>
                            <td><input type="checkbox" name="remover[]" value="{{$cu->id}}"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
        </div>
        <div class="col-sm-6">
            <form method="post" action="{{url('/admin/rol/agregar-cu')}}">
                <div class="row">
                    <div class="col-sm-7">
                        <h3>Caso de Uso Disponibles</h3>
                    </div>
                    <div class="col-sm-2"><br><br>
                        <button class="btn btn-success">AgregarCU</button>
                    </div>
                </div>
                {{ csrf_field() }}
                <input type="hidden" value="{{$rol->id}}" name="rol">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Caso de uso</th>
                        <th>Opcion</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($cuDisponibles as $cu)
                        <tr>
                            <td>{{$cu->nombre}}</td>
                            <td><input type="checkbox" name="agregar[]" value="{{$cu->id}}"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </form>
        </div>
    </div>
@endsection