@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

		<a href='{!!url("admin/promocion")!!}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> Crear Promocion</a>

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
						<a href="{{ url('admin/promocion/'.$promocione->id.'/productos') }}  ">
							<button class="btn btn-info">Ver Productos</button>
						</a>

							<button class="btn btn-info" data-toggle="modal" data-target="#myModal">Editar</button>

						<a href="#">
							<button class="btn btn-info">Eliminar</button>
						</a>
					</td>

				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			</div>

		</div>
	</div>
</div>
@endsection