@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Categorias de Productos <a href="{{URL::action('Compras\CategoriaProductoController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.Compras.categorias.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
                    <th>Opciones</th>
				</thead>
               @foreach ($categoria as $cat)
				<tr>
					<td>{{ $cat->id}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>
						<a href="{{URL::action('Compras\CategoriaProductoController@edit',$cat->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
                @include('admin.Compras.categorias.modal')
				@endforeach
			</table>
		</div>
		{{$categoria->render()}}
	</div>
</div>
@endsection