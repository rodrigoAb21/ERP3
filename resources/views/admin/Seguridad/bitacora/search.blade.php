<form action="" class="form-inline">
	<div class="form-group">
		<label for="empleado_id">Empleado:</label><br>
		<select name="empleado_id" class="btn btn-default form-control">
			<option value="0">--Todos--</option>
			@foreach($empleados as $empleado)
				<option value="{{$empleado->id}}">{{$empleado->nombre}}({{$empleado->rol->nombre}})</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label for="tiempo">Desde :</label><br>
		<select name="tiempo" class="btn btn-default form-control">
			<option value="1">Hoy</option>
			<option value="1">Ayer</option>
			<option value="1">Hace 1 Semana</option>
			<option value="1">Hace 1 mes</option>
		</select>
	</div>
	<div class="form-group">
		<button class="btn btn-info">Buscar</button>
	</div>

</form>

