@extends ('admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Categoria Cliente <a href="{{URL::action('CRM\CategoriaClienteController@create')}}"><button class="btn btn-success">Nueva</button></a></h3>
            @include('admin.CRM.categoria.search')
        </div>
    </div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
                    <th>Nombre</th>
                    <th>Puntos Minimos</th>
                    <th>Monto minimos</th>
					<th>Opciones</th>
				</thead>
               @foreach ($categorias as $categoria)
				<tr>
                    <td>{{ $categoria -> nombre}}</td>
                    <td>{{ $categoria -> puntosRequeridos}}</td>
                    <td>{{ $categoria -> montoRequerido}}</td>
					<td>
                        <a href="{{URL::action('CRM\CategoriaClienteController@edit',$categoria->id)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$categoria->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        <a href="{{url('admin/categoriaCliente/'.$categoria->id.'/beneficios')}}"><button class="btn btn-info">EditarBeneficios</button></a>
                        <a href="{{url('admin/categoriaCliente/'.$categoria->id.'/promociones')}}"><button class="btn btn-warning">EditarPromociones</button></a>

                    </td>
				</tr>
                    @include('admin.CRM.categoria.modal')
				@endforeach
			</table>
		</div>
        {{$categorias->render()}}
	</div>
</div>

@endsection