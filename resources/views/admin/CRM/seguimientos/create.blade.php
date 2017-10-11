@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Nuevo Seguimiento</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'admin/seguimientos','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Cliente</label>
                    <select name="idCliente" class="form-control selectpicker" data-live-search="true">
                        @foreach ($cliente as $cli)
                            <option value="{{$cli -> id}}">{{$cli -> nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Empleado</label>
                    <select name="idEmpleado" class="form-control selectpicker" data-live-search="true">
                        @foreach ($empleado as $emp)
                            <option value="{{$emp -> id}}">{{$emp -> nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Estado</label>
                    <select name="idEstado" class="form-control selectpicker" data-live-search="true">
                        @foreach ($estado as $est)
                            <option value="{{$est -> id}}">{{$est -> nombre}}</option>
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