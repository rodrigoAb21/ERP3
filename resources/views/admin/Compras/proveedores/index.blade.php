@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Proveedores <a href="{{URL::action('Compras\ProveedorController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.Compras.proveedores.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
                    <th>Empresa</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Opciones</th>
				</thead>
               @foreach ($proveedor as $pro)
				<tr>
					<td>{{ $pro->id}}</td>
					<td>{{ $pro->nombre}}</td>
                    <td>{{ $pro->empresa}}</td>
                    <td>{{ $pro->direccion}}</td>
                    <td>{{ $pro->telefono}}</td>
					<td>
						<a href="{{URL::action('Compras\ProveedorController@edit',$pro->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$pro->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
                @include('admin.Compras.proveedores.modal')
				@endforeach
			</table>
		</div>
		{{$proveedor->render()}}
	</div>
</div>
@endsection