<div class="modal fade" id="remover" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Remover Productos</h4>
            </div>
            <form method='POST' action= {{url("admin/promocion/'.$promocion->id.'/remover")}}>
                {{ csrf_field() }}
                <input type="hidden" value="{{$promocion->id}}" name="id">
                <div class="panel-body">
                    <div class="modal-body">

                        @foreach($promocion->productos as $producto)
                            <div class="row">
                                <label>{{$producto->nombre}}</label>
                                <input type="checkbox" name="producto[]" value="{{$producto->id}}">

                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="modal-footer">
                    <button class='btn btn-success' type='submit'>
                        <i class="fa fa-floppy-o"></i>Remover
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>