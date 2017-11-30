@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Cuota Nro: {{$cuota[0] -> idCredito}} <a href="{{asset('admin/creditos')}}"><button class="btn btn-warning">Atras</button></a> </h3>

	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-condensed table-hover table-bordered">
				<thead>
					<th>Nro</th>
					<th>Fecha</th>
                    <th>Monto</th>
                    <th>Estado</th>
					<th>Opciones</th>
				</thead>

               @foreach ($cuota as $cuo)
				<tr>
					<td>{{$loop -> index + 1}}</td>
					<td>{{ $cuo->fecha}}</td>
                    <td>{{ $cuo->monto}}</td>
                    <td>{{ $cuo->estado}}</td>
					<td>
                        <a href="" data-target="#modal-delete-{{$cuo->id}}" data-toggle="modal"><button class="btn btn-primary"> Pagar </button></a>
					</td>
				</tr>
				@include('admin.Ventas.cuotas.modal')
				@endforeach
			</table>
		</div>
		{{$cuota -> render()}}
	</div>
</div>
@endsection