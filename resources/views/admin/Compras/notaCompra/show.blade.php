@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		<a href="{{url('admin/notacompra')}}" class="btn btn-md btn-default">
			Atras</a>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Compra </h3>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		<br><br><br>@if($compra->finalizado==0)
			<a href="{{url('admin/ingreso/'.$compra->id)}}" class="btn btn-md btn-danger">
				Reabastecer</a>
		@endif
	</div>

</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<p>Numero: {{$compra->id}}</p>
		<p>Fecha: {{Carbon\Carbon::parse($compra->fecha)->format('d-m-Y h:i A')}}</p>
		<p>Total: {{$compra->montoTotal}}</p>
		<p>Proveedor: {{$compra->proveedor->empresa}}</p>

		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
				<th>#</th>
					<th>Producto</th>
                    <th>precio Unitario ( $ )</th>
				<th>Cantidad</th>
				<th>Subtotal ( $ )</th>
				</thead>
				@foreach($compra->productos as $producto)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$producto->nombre}}</td>
					<td>{{$producto->pivot->precioU}}</td>
					<td>{{$producto->pivot->cantidad}}</td>
					<td>{{$producto->pivot->subtotal}}</td>
				</tr>
					@endforeach

			</table>
		</div>
	</div>
</div>
@endsection