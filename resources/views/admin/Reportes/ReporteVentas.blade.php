@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
		<h2 align="center">Ventas del mes</h2>
        <div class="table-responsive">
            <table class="table table-striped table-condensed table-hover table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario Venta</th>
                    <th>Ganancia</th>
                    <th>Ganancia Neta</th>
                </tr>
                </thead>
                @foreach ($mV as $masV)
                    <tr>
                        <td>{{ $masV->id}}</td>
                        <td>{{ $masV->nombre }}</td>
                        <td>{{ $masV->cantidad}}</td>
                        <td>{{ $masV->precioV}}</td>
                        <td>{{ $masV->ganancia}}</td>
                        <td>{{ $masV->ganancia_neta}}</td>
                    </tr>
                @endforeach

            </table>
        </div>
        <a><button class="btn btn-danger" onclick="printHTML()" >Imprimir <i class="fa fa-print"></i></button></a> <a><button class="btn btn-primary">PDF  <i class="fa fa-download"></i></button></a>
		</div>
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