@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Empleados <a href="{{URL::action('Seguridad\EmpleadoController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.Seguridad.empleados.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Tipo</th>
                    <th>Ocupacion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($empleado as $emple)
				<tr>
                    <td>{{ $emple->ci}}</td>
                    <td>{{ $emple->nombre}}</td>
                    <td>{{ $emple->direccion}}</td>
                    <td>{{  $emple->rol->nombre}}</td>
                    <td>{{ $emple->ocupacion}}</td>
					<td>
						<a href="{{URL::action('Seguridad\EmpleadoController@edit',$emple->id)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$emple->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
                    @include('admin.Seguridad.empleados.modal')
				@endforeach
			</table>
		</div>
		{{$empleado->render()}}
	</div>
</div>
@endsection
