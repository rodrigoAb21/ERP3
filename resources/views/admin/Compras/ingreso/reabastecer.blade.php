@extends ('admin')

@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <h2>Reabastecer A Tiendas </h2>
            <p>Origen de productos: NotaCompra Nº{{$compra->id}}  </p>
            <p>Fecha:  {{Carbon\Carbon::parse($compra->fecha)->format('d-m-Y h:i A')}}  </p>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4>Productos Disponibles:</h4>
            <table class="table table-striped table-condensed table-hover table-bordered">
                <thead>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                </thead>
                @foreach($compra->productos as $producto)
                <tr>
                    <td>{{$producto->id}}</td>
                    <td>{{$producto->nombre}}</td>
                    <td>{{$producto->pivot->cantidad}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <br>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <form action="{{url('admin/ingreso')}}" method="POST" >{{ csrf_field() }}
                <input type="hidden" id="compra_id" name="compra_id" value="{{$compra->id}}" >

                <div class="card " style="width: 100%">
                    @foreach($puntosVenta as $pv)
                        <div class="card-block well">
                            <h4 class="card-title">{{$pv->nombre}}</h4>
                            <p class="card-text">
                                @foreach($compra->productos as $producto)

                                        <label for="v{{$pv->id.'p'.$producto->id}}">{{$producto->nombre}}</label>
                                        <input type="number" style="width: 40px; margin-right: 30px"
                                               name="v{{$pv->id.'p'.$producto->id}}" value="0">
                                @endforeach
                            </p>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-md btn-primary" >Guardar</button>
            </form>
        </div>

    </div>
@endsection
