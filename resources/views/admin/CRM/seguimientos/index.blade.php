@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Seguimiento <a href="{{URL::action('CRM\SeguimientoController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.CRM.seguimientos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>F.Inicio</th>
					<th>Cliente</th>
					<th>Empleado</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($seguimiento as $segui)
				<tr>
					<td>{{ $segui->id}}</td>
                    <td>{{ $segui->fechaInicio}}</td>
                    <td>{{ $segui->cliente}}</td>
                    <td>{{ $segui->empleado}}</td>
					<td>{{ $segui->estado}}</td>
					<td>
						<a href="{{URL::action('CRM\SeguimientoController@edit',$segui->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$segui->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.CRM.seguimientos.modal')
				@endforeach
			</table>
		</div>
		{{$seguimiento->render()}}
	</div>
</div>
@endsection