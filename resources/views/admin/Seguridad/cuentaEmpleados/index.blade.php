@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Cuentas de Empleados</h3>
		@include('admin.Seguridad.cuentaEmpleados.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo</th>
					<th>Opciones</th>
				</thead>
               @foreach ($usuario as $usu)
				<tr>
					<td>{{ $usu->name}}</td>
                    <td>{{ $usu->email}}</td>
                    <td>{{ $usu->tipo}}</td>
					<td>
						<a href="{{URL::action('Seguridad\CuentaEmpleadoController@edit',$usu->id)}}"><button class="btn btn-info">Editar</button></a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$usuario->render()}}
	</div>
</div>
@endsection