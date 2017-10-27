@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Tipos <a href="{{URL::action('Compras\TipoController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.Compras.tipos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Categoria</th>
                    <th>Opciones</th>
				</thead>
               @foreach ($tipo as $tip)
				<tr>
					<td>{{ $tip->id}}</td>
					<td>{{ $tip->nombre}}</td>
					<td>{{ $tip->categoria}}</td>
					<td>
						<a href="{{URL::action('Compras\TipoController@edit',$tip->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$tip->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
                @include('admin.Compras.tipos.modal')
				@endforeach
			</table>
		</div>
		{{$tipo->render()}}
	</div>
</div>
@endsection