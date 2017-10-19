<form action="{{url('/admin/bitacora')}}" class="form-inline" method="GET">
	<div class="form-group">
		<label for="empleado_id">Empleado:</label><br>
		<select name="empleado_id" class="btn btn-default form-control">
			<option value="0">--Todos--</option>
			@foreach($empleados as $empleado)
				<option value="{{$empleado->id}}"
				@if($user_id==$empleado->id)
					selected
						@endif
				>{{$empleado->nombre}}({{$empleado->rol->nombre}})</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label for="tiempo">Desde :</label><br>
		<select name="tiempo" class="btn btn-default form-control">
			<option value="1" @if ($tiempo==1) selected @endif >Hoy</option>
			<option value="2" @if ($tiempo==2) selected @endif >Ayer</option>
			<option value="3" @if ($tiempo==3) selected @endif>Hace 1 Semana</option>
			<option value="4" @if ($tiempo==4) selected @endif>Hace 1 mes</option>
		</select>
	</div>
	<div class="form-group">
		<button class="btn btn-info">Buscar</button>
	</div>

</form>

