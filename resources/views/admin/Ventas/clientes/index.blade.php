@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Clientes <a href="{{URL::action('Ventas\ClienteController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.Ventas.clientes.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
                    <th>Direccion</th>
                    <th>Pts Acumulados</th>
                    <th>Opciones</th>
				</thead>
               @foreach ($cliente as $cli)
				<tr>
					<td>{{ $cli->id}}</td>
					<td>{{ $cli->nombre}}</td>
					<td>{{ $cli->direccion}}</td>
                    <td>{{ $cli->puntosAcumulados}}</td>
					<td>
						<a href="{{URL::action('Ventas\ClienteController@edit',$cli->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$cli->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
                @include('admin.Ventas.clientes.modal')
				@endforeach
			</table>
		</div>
		{{$cliente->render()}}
	</div>
</div>
@endsection