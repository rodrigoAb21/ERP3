@extends ('admin')
@section ('contenido')
        <div class="col-sm-10 well" >
            <form method="post"  action="{{url('/admin/actualizar-acciones')}}">
                <h2>Editar Acciones </h2>
            <p>Caso de Uso :{{$cu->nombre}} ( {{$rol->nombre}})</p>
<br>

                {{ csrf_field() }}
                <input type="hidden" value="{{$cu->id}}" name="cu">
                <input type="hidden" value="{{$rol->id}}" name="rol">
                <div class="form-group">
                    <label><input type="checkbox"
                                  @if($cu->pivot->leer==1) checked @endif
                                  name="leer"> Leer</label>
                    <p>El usuario podra <b>ver</b> la informacion de {{$cu->nombre}} del sistema.</p>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" @if($cu->pivot->crear==1) checked @endif name="crear"> Crear</label>
                    <p>El usuario podra <b>crear </b> registros de {{$cu->nombre}} del sistema.</p>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" @if($cu->pivot->editar==1) checked @endif name="editar"> Editar</label>
                    <p>El usuario podra <b>actualizar </b> los registros de {{$cu->nombre}} del sistema.</p>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" @if($cu->pivot->eliminar==1) checked @endif name="eliminar"> Eliminar</label>
                    <p>El usuario podra <b>eliminar </b> los registros de {{$cu->nombre}} del sistema.</p>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-info">Actualizar</button>
                </div>
            </form>


        </div>
@endsection