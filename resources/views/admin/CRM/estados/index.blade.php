@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Estados <a href="{{URL::action('CRM\EstadoController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.CRM.estados.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Tipo</th>
					<th>Opciones</th>
				</thead>
               @foreach ($estado as $est)
				<tr>
					<td>{{ $est->id}}</td>
					<td>{{ $est->nombre}}</td>
                    <td>{{ $est->descripcion}}</td>
                    <td>{{ $est->tipo}}</td>
					<td>
						<a href="{{URL::action('CRM\EstadoController@edit',$est->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$est->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.CRM.estados.modal')
				@endforeach
			</table>
		</div>
		{{$estado->render()}}
	</div>
</div>
@endsection