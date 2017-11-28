@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		@include('flash::message')
		<h3>Compras </h3>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<a href="{{url('admin/notacompra/create')}}" class="btn btn-md btn-primary">
			Crear Nota Compra</a>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>#</th>
					<th>fecha Realizada</th>
                    <th>Monto Total ( $ )</th>
				<th>Proveedor</th>

				<th>Opciones</th>
				</thead>
			@foreach($compras as $compra)
				<tr>
					<td>{{$compra->id}}</td>
					<td>{{Carbon\Carbon::parse($compra->fecha)->format('d-m-Y h:i A')}}</td>
					<td>{{$compra->montoTotal}}</td>
					<td>{{$compra->proveedor->empresa}}</td>

					<td>
						<a href='{{url('admin/notacompra/show/'.$compra->id)}}' class="btn btn-info">Ver</a>
					</td>
				</tr>
			@endforeach
			</table>
		</div>
	</div>
</div>
@endsection