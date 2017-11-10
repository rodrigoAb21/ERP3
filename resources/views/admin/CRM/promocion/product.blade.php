@extends ('admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a href='{!!url("admin/promocion")!!}' class='btn btn-default'><i class="fa fa-backward"></i>_Lista de
                Promociones</a>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Productos en {{$promocion->nombre}}</h3>
            <h4>Valido desde {{$promocion->fechaEmpieza}} hasta {{$promocion->fechaTermina}}</h4>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><br>
            <button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#agregar">Agregar Mas Productos
            </button>
            <button type="button" class="btn btn-danger"
                    data-toggle="modal" data-target="#remover">Quitar Productos
            </button>
        </div>
    </div>
    <div class="row" style="">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default" style="border-color: #00796B;border-style: solid;">
                <form method='POST' action="{{url('admin/promocion/actualizarPrecio')}}">{{ csrf_field() }}
                    <input type="hidden" value="{{$promocion->id}}" name="promo_id">
                    <table class="table table-responsive table-bordered ">
                        <thead>
                        <th>Producto</th>
                        <th>PrecioPromo</th>
                        </thead>
                        <tbody>
                        @foreach ($promocion->productos as $producto)
                            <tr>
                                <input type="hidden" name="producto[]" value="{{$producto->id}}">
                                <td>{{ $producto->nombre}}</td>
                                <td><input name="precio[]" type="text" value="{{ $producto->pivot->precio}}"></td>
                            </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td ><button  class='btn btn-success' type='submit'>Guardar Cambios</button></td>
                        </tr>
                        </tbody>
                    </table>

                </form>
            </div>
        </div>
    </div>
    @include('admin.CRM.promocion.agregar')
@include('admin.CRM.promocion.remover')
@endsection