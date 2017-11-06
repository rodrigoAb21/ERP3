@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		@include('admin.Seguridad.bitacora.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
                    <th>#</th>
                    <th>Empleado</th>
                    <th>FechaIngreso / Hora </th>
					<th>Opciones</th>
				</thead>
               @foreach ($bitacoras as $bitacora)
				<tr>
                    <td>{{ $bitacora->id}}</td>

                    <td>{{ $bitacora->user->name.' ( '.$bitacora->user->empleado->rol->nombre.' )'}}</td>
                    {{--<td>{{ $bitacora->fechaEntrada}}</td>--}}
					<td>{{Carbon\Carbon::parse($bitacora->fechaEntrada)->format('d-m-Y h:i A')}}</td>
					<td>
						<a href="{{url('/admin/bitacora/'.$bitacora->id)}}"><button class="btn btn-sm btn-default">VerActividad</button></a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection
