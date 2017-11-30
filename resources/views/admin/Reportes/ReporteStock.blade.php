@extends ('admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<h2 align="center">Lista Productos del Punto: {{$punto -> nombre}}</h2>
        <div class="table-responsive">
            <table class="table table-striped table-condensed table-hover table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Stock Minimo</th>
                    <th>Stock Actual</th>
                </tr>
                </thead>
                @foreach ($stock as $masV)
                    <tr>
                        <td>{{ $masV->id}}</td>
                        <td>{{ $masV->nombre }}</td>
                        <td>{{ $masV->minimo}}</td>
                        <td>{{ $masV->actual}}</td>
                    </tr>
                @endforeach

            </table>
        </div>
        <a><button class="btn btn-danger" onclick="printHTML()" >Imprimir <i class="fa fa-print"></i></button></a> <a href="{{asset('admin/reportes/ReporteStocks/PDF/'.$punto -> id)}}"><button class="btn btn-primary">PDF  <i class="fa fa-download"></i></button></a>

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