@extends ('admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<a href="{{url('/admin/bitacora')}}" class="btn btn-info btn-sm">Atras</a>
	<h4>Acciones realizadas por el Usuario<b> {{ $bitacora->user->name.' ( '.$bitacora->user->empleado->rol->nombre.' )'}}</b></h4><br>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			@if($bitacora->acciones=='[]')
				<h3>El usuario no ha realizado acciones.</h3>
			@else
				<table class="table table-striped table-condensed table-hover table-bordered">
					<thead>
					<th>#</th>
					<th>Accion Realizada</th>
					<th>Tabla Afectada</th>
					<th>Tupla Afectada</th>
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
			@endif

		</div>
	</div>
</div>
@endsection
