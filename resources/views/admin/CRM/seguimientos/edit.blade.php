@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Seguimiento No.: {{$seguimiento -> id}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($seguimiento,['method'=>'PATCH','route'=>['seguimientos.update',$seguimiento -> id]])!!}
            {{Form::token()}}

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Cliente</label>
                    <select name="idCliente" class="form-control selectpicker" data-live-search="true">
                        @foreach ($cliente as $cli)
                            @if($cli -> id == $seguimiento -> idCliente)
                                <option value="{{$cli -> id}}" selected>{{$cli -> nombre}}</option>
                            @else
                                <option value="{{$cli -> id}}">{{$cli -> nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Empleado</label>
                    <select name="idEmpleado" class="form-control selectpicker" data-live-search="true">
                        @foreach ($empleado as $emp)
                            @if($emp -> id == $seguimiento -> idEmpleado)
                                <option value="{{$emp -> id}}" selected>{{$emp -> nombre}}</option>
                            @else
                                <option value="{{$emp -> id}}">{{$emp -> nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Estado</label>
                    <select name="idEstado" class="form-control selectpicker" data-live-search="true">
                        @foreach ($estado as $est)
                            @if($est -> id == $seguimiento -> idEstado)
                                <option value="{{$est -> id}}" selected>{{$est -> nombre}}</option>
                            @else
                                <option value="{{$est -> id}}">{{$est -> nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
            </div>



            {!!Form::close()!!}
            
		</div>
	</div>
@endsection