@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Tarea: {{$categoria -> nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($categoria,['method'=>'PATCH','route'=>['categoria.update',$categoria -> id]])!!}
            {{Form::token()}}

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{$categoria -> nombre}}" required autofocus>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" class="form-control" value="{{$categoria -> descripcion}}" required>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="puntosRequeridos">Puntos</label>
                    <input type="text" name="puntosRequeridos" class="form-control" value="{{$categoria -> puntosRequeridos}}" required>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="frecuenciaRequerida">Frecuencia</label>
                    <input type="text" name="frecuenciaRequerida" class="form-control" value="{{$categoria -> frecuenciaRequerida}}" required>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="montoRequerido">Monto</label>
                    <input type="text" name="montoRequerido" class="form-control" value="{{$categoria -> montoRequerido}}" required>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="cantDiasReserva">Dias de reserva</label>
                    <input type="text" name="cantDiasReserva" class="form-control" value="{{$categoria -> cantDiasReserva}}" required>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="cantProdReserva">Cantidad de productos de reserva</label>
                    <input type="text" name="cantProdReserva" class="form-control" value="{{$categoria -> cantProdReserva}}" required>
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