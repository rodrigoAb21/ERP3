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
					<label>Punto de Venta</label>
					<select name="punto_id" class="form-control selectpicker" data-live-search="true">
						@foreach ($punto as $p)
							<option value="{{$p -> nombre}}">{{$p -> nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="descripcion">Mes</label>
                    <select name="mes" id="mes" class="form-control">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
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