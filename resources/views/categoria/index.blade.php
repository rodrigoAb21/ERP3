@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

		<a href='{!!url("admin/categoria")!!}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> Crear Categoria</a>

	</div><br><br>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
                    <th>Nombre</th>
                    <th>Descripcion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($categorias as $categoria)
				<tr>
                    <td>{{ $categoria->nombre}}</td>
                    <td>{{ $categoria->descripcion}}</td>
					<td>
						<a href="{{ url('admin/categoria/'.$categoria->id.'/beneficios') }}  ">
							<button class="btn btn-info">Ver Beneficios</button>
						</a>
						<a href="{{ url('admin/categoria/'.$categoria->id.'/destroy') }} ">
							<button class="btn btn-info">Eliminar</button>
						</a>
					</td>

				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection