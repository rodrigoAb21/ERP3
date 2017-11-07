@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

		<a href='{{url("admin/promocion")}}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> Crear Promocion</a>

	</div><br><br>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
                    <th>Promocion</th>
                    <th>fecha de Inicio</th>
                    <th>fecha Finalizacion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($promociones as $promocione)
				<tr>
                    <td>{{ $promocione->nombre}}</td>
                    <td>{{ $promocione->fechaEmpieza}}</td>
                    <td>{{ $promocione->fechaTermina}}</td>
					<td>
						<a href="{{url('admin/promocion/'.$promocione->id.'/edit')}}" class="btn btn-info">Editar</a>
						<a href="{{ url('admin/promocion/'.$promocione->id.'/delete') }}  " class="btn btn-danger">Eliminar</a>
						<a href="{{ url('admin/promocion/'.$promocione->id.'/editarProductos') }}  " class="btn btn-warning">EditarProductos</a>

					</td>

				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection