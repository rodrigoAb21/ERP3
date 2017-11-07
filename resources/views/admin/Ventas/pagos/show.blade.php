@extends ('admin')
@section ('contenido')
 <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Pago #: {{$pago -> id}}</h3>
        <h4>Fecha: {{$pago -> fecha}}</h4>
    </div>
 </div>

<div class="row">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label>Empleado</label>
            <p>{{$pago -> empleado}}</p>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label>NIT</label>
            <p>{{$pago -> nit}}</p>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label>Nombre</label>
            <p>{{$pago -> nombre}}</p>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label>Cliente</label>
            <p>{{$pago -> cliente}}</p>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label>Punto de Venta</label>
            <p>{{$pago -> punto}}</p>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <label for="montoTotal">Monto Total</label>
            <p>{{$pago -> montoTotal}}</p>
        </div>
    </div>

</div>
<div class="row">
    <div class="table-responsive">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="carrito" class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #A9D0F5">
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>P. Unitario</th>
                <th>Precio</th>
                </thead>
                <tbody>
                @foreach($detalle as $det)
                    <tr>
                        <td>{{$det -> nombre}}</td>
                        <td>{{$det -> cantidad}}</td>
                        <td>{{$det -> precioActual}}</td>
                        <td>{{$det -> subtotal}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th><h4>TOTAL</h4></th>
                    <th></th>
                    <th></th>
                    <th><h4>Bs. {{$pago -> montoTotal}}</h4></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection