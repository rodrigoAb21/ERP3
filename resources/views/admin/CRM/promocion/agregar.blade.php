<div class="modal fade" id="agregar" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">AgregarProductos</h4>
            </div>
            <form method='POST' action= {{url("admin/promocion/".$promocion->id.'/agregar')}}>
                {{ csrf_field() }}
                <input type='hidden' name='id' value='{{$promocion->id}}'>

                <div class="panel-body">
                    <div class="modal-body">

                        @foreach($otros_productos as $otros_producto)
                            <div class="row">
                                <label for="producto">{{$otros_producto->nombre}}</label>
                                <input value="{{$otros_producto->id}}" type="checkbox" name="producto[]">
                                <input value="{{$otros_producto->precioUVenta}}" type="text" readonly name="precio[]">
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