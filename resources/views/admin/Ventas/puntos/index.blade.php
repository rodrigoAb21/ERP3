@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Puntos de Venta <a href="{{URL::action('Ventas\PuntoController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.Ventas.puntos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
                    <th>Ubicación</th>
					<th>Opciones</th>
				</thead>
               @foreach ($punto as $pun)
				<tr>
					<td>{{ $pun->id}}</td>
					<td>{{ $pun->nombre}}</td>
                    <td>{{ $pun->ubicacion}}</td>
					<td>
						<a href="{{URL::action('Ventas\PuntoController@edit',$pun->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$pun->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.Ventas.puntos.modal')
				@endforeach
			</table>
		</div>
		{{$punto->render()}}
	</div>
</div>
@endsection