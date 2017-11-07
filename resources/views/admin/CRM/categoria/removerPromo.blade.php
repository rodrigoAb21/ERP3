<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <form method='POST' action= {!!url("admin/categoriaCliente/".$categoria->id.'/removerPromo')!!}>
                {{ csrf_field() }}
                <input type='hidden' name='id' value='{{$categoria->id}}'>

                <div class="panel-body">
                    <div class="modal-body">

                        @foreach($categoria->promociones as $item)
                            <div class="row">
                                <label>{{$item->nombre}}</label>
                                <input type="checkbox" value="{{$item->id}}" name="promo[]">
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="modal-footer">
                    <button class='btn btn-danger' type='submit'>
                        <i class="fa fa-floppy-o"></i>remover
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>