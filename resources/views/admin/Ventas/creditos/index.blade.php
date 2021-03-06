@extends('admin')
@section('contenido')


<div class="row">
	<div class="col-lg-8 col-md-8 col-sm8 col-xs-12">
		
<h3>Pagos al Credito<a href="{{URL::action('Ventas\CreditoController@create')}}"> <button class="btn btn-success">Nuevo</button></a> <a><button class="btn btn-danger" onclick="printHTML()" ><i class="fa fa-print"></i> Imprimir</button></a> </h3>
@include('admin.Ventas.creditos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-13 col-md-11 col-sm-11 col-xs-13">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered" >
				<thead>
					<th style="text-align: center">Codigo</th>
					<th style="text-align: center">Fecha</th>
					<th>Estado</th>
					<th>Cliente</th>
					<th style="text-align: center">Monto Total</th>
					<th style="text-align: center">Opciones</th>
				</thead>
               @foreach ($pago as $pa)
				<tr >
					<td>{{$pa -> id}}</td>
					<td>{{$pa -> fecha}}</td>
					<td>{{$pa -> estado}}</td>
                    <td>{{$pa -> nombre}}</td>
                    <td>{{$pa -> montoTotal}}</td>
					<td>
                        <a href="{{URL::action('Ventas\CreditoController@show',$pa -> id)}}"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
                        <a href="{{asset('admin/creditos/'.$pa->id.'/cuotas')}}"><button class="btn btn-success">Cuotas</button></a>
                        <a href="" data-target="#modal-delete-{{$pa->id}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                    </td>
				</tr>
                @include('admin.Ventas.creditos.modal')
				@endforeach
			</table>
		</div>
		{{$pago->render()}}
	</div>
</div>
<script>
    function printHTML() {
        if (window.print) {
            window.print();
        }
    }
</script>
@endsection