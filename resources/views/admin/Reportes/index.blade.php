@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3> Reporte de Ventas </h3>
			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!!Form::open(array('url'=>'admin/reportes/ReporteVentas','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="nombre">Punto de Venta</label>
					<input type="text" name="puntoVenta" class="form-control" required autofocus>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="descripcion">Mes</label>
					<input type="number" name="mes" class="form-control">
				</div>
			</div>

		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Aceptar</button>
			</div>
		</div>

		{!!Form::close()!!}

	</div>
@endsection