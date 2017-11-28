@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<h3>Inventario </h3>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			@foreach($puntosVenta as $punto)
			<div class="well " >
			<p><b>Punto de Venta: </b>{{$punto->nombre}}</p>
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>

					<th>#</th>
					<th>Producto</th>
                    <th>Estado</th>
					<th>PrecioUCompra</th>
					<th>PrecioUVenta</th>
					<th>Stock</th>
					<th>StockMinimo</th>
				</thead>
			@foreach($punto->productos as $producto)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$producto->nombre}}</td>
					<td>
						@if($producto->promociones!='[]')
							<a href="{{url('admin/showPromociones/'.$producto->id)}}" class="btn btn-sm btn-default">verPromociones</a>
						@else
							Ninguna Promocion
							@endif
					</td>
					<td>{{$producto->precioUCompra}}</td>
					<td>{{$producto->precioUVenta}}</td>
					<td>{{$producto->pivot->stock}}</td>
					<td>{{$producto->pivot->stock}}</td>
				</tr>
			@endforeach
			</table>
			</div>
				<br><br>
				@endforeach
		</div>
	</div>
</div>
@endsection