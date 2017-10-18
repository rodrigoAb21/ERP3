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
            <button type="button" class="btn btn-adn"
                    data-toggle="modal" data-target="#myModal">Agregar Mas Productos
            </button>
            <button type="button" class="btn btn-danger"
                    data-toggle="modal" data-target="#myModal2">Quitar Productos
            </button>
        </div>
    </div>
    <div class="row" style="">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default" style="border-color: #00796B;border-style: solid;">
                <form method='POST' action= {!!url("admin/promocion/".$promocion->id.'/actualizarCantidad')!!}>
                    <table class="table table-responsive table-bordered ">
                        <thead>
                        <th>Producto</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        </thead>
                        <tbody>
                        <input type='hidden' name='_token' value='{{Session::token()}}'>
                        @foreach ($productos as $producto)
                            <tr>
                                <input type="hidden" name="productos[]" value="{{$producto->id}}">
                                <td>{{ $producto->nombre}}</td>
                                <td>{{ $producto->especificacion}}</td>
                                <td><input name="cantidades[]" value="{{ $producto->pivot->cantidad}}"></td>
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <form method='POST' action= {!!url("admin/promocion/".$promocion->id.'/agregarProductos')!!}>
                    <input type='hidden' name='_token' value='{{Session::token()}}'>
                    <input type='hidden' name='id' value='{{$promocion->id}}'>

                    <div class="panel-body">
                        <div class="modal-body">

                            @foreach($otros_productos as $otros_producto)
                                <div class="row">

                                    {!! Form::checkbox('productos[]', $otros_producto->id) !!}

                                    {!! Form::label('otros', $otros_producto->nombre) !!}
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class='btn btn-success' type='submit'>
                            <i class="fa fa-floppy-o"></i>Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <form method='POST' action= {!!url("admin/promocion/".$promocion->id.'/removerProducto')!!}>
                    <input type='hidden' name='_token' value='{{Session::token()}}'>
                    <input type='hidden' name='id' value='{{$promocion->id}}'>

                    <div class="panel-body">
                        <div class="modal-body">

                            @foreach($otros_productos as $otros_producto)
                                <div class="row">

                                    {!! Form::checkbox('productos[]', $otros_producto->id) !!}

                                    {!! Form::label('otros', $otros_producto->nombre) !!}
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class='btn btn-success' type='submit'>
                            <i class="fa fa-floppy-o"></i>Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection