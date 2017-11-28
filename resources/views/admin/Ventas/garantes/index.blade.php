@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Garantes</h3>
		@include('admin.Ventas.garantes.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>Carnet</th>
					<th>Nombre</th>
                    <th>Telefono</th>
                    <th>Credito</th>
					<th>Opciones</th>
				</thead>
               @foreach ($garante as $gar)
				<tr>
					<td>{{ $gar->id}}</td>
					<td>{{ $gar->ci}}</td>
					<td>{{ $gar->nombre}}</td>
                    <td>{{ $gar->telefono}}</td>
                    <td>{{ $gar->credito}}</td>
					<td>
						<a href="{{URL::action('Ventas\GaranteController@edit',$gar->id)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="{{URL::action('Ventas\GaranteController@show',$gar -> id)}}"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$garante->render()}}
	</div>
</div>
@endsection