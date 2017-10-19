@extends ('admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h4>Acciones realizadas por el Usuario<b> {{$bitacora->user->name}}</b></h4><br>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
                    <th>#</th>
                    <th>Accion Realizada</th>
                    <th>Tabla Afectada</th>
					<th>Numero de Tupla</th>
				</thead>
               @foreach ($bitacora->acciones as $accione)
				<tr>
                    <td>{{ $accione->id}}</td>
                    <td>{{ $accione->accion}}</td>
					<td>{{$accione->tabla}}</td>
					<td>{{$accione->tupla}}</td>

				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection
