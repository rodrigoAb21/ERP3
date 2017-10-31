<form action="{{url('/admin/bitacora')}}" class="form-inline" method="GET">
	
	<div class="form-group">
		<label for="tiempo">Desde :</label><br>
		<select name="tiempo" class="btn btn-default form-control">
			<option value="1" >Hoy</option>
			<option value="2"  >Ayer</option>
			<option value="3" >Hace 1 Semana</option>
			<option value="4" >Hace 1 mes</option>
		</select>
	</div>
	<div class="form-group">
		<button class="btn btn-info">Buscar</button>
	</div>

</form>

