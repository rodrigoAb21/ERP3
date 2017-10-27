@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Productos <a href="{{URL::action('Compras\ProductoController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.Compras.productos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Precio Actual</th>
					<th>Categoria</th>
                    <th>Imagen</th>
                    <th>Opciones</th>
				</thead>
               @foreach ($producto as $prod)
				<tr>
					<td>{{ $prod->id}}</td>
					<td>{{ $prod->nombre}}</td>
					<td>{{ $prod->precioActual}}</td>
					<td>{{ $prod->tipo}}</td>
                    <td>
                        <img src="{{asset('img/productos/'.$prod -> imagen)}}" alt="{{$prod -> nombre}}" height="100px" width="100px" class="img-thumbnail">
                    </td>
                    <td>
						<a href="{{URL::action('Compras\ProductoController@edit',$prod->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$prod->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
                @include('admin.Compras.productos.modal')
				@endforeach
			</table>
		</div>
		{{$producto->render()}}
	</div>
</div>
@endsection