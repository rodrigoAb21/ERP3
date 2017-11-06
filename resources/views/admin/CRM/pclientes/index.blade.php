@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Posibles Clientes <a href="{{URL::action('CRM\PClienteController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.CRM.pclientes.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>ID</th>
					<th>Carnet</th>
					<th>Nombre</th>
                    <th>Telefono</th>
                    <th>Opciones</th>
				</thead>
               @foreach ($cliente as $cli)
				<tr>
					<td>{{ $cli->id}}</td>
					<td>{{ $cli->ci}}</td>
					<td>{{ $cli->nombre}}</td>
					<td>{{ $cli->telefono}}</td>
					<td>
						<a href="{{URL::action('CRM\PClienteController@edit',$cli->id)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-promover-{{$cli->id}}" data-toggle="modal"><button class="btn btn-success">Promover</button></a>
                        <a href="" data-target="#modal-delete-{{$cli->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
                @include('admin.CRM.pclientes.modal')
                @include('admin.CRM.pclientes.modal2')
				@endforeach
			</table>
		</div>
		{{$cliente->render()}}
	</div>
</div>
@endsection