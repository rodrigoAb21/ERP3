@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Tareas <a href="{{URL::action('CRM\TareaController@create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.CRM.tareas.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
                    <th>Descripcion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($tarea as $tar)
				<tr>
					<td>{{ $tar->id}}</td>
					<td>{{ $tar->nombre}}</td>
                    <td>{{ $tar->descripcion}}</td>
					<td>
						<a href="{{URL::action('CRM\TareaController@edit',$tar->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$tar->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.CRM.tareas.modal')
				@endforeach
			</table>
		</div>
		{{$tarea->render()}}
	</div>
</div>
@endsection