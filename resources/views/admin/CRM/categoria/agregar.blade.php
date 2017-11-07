<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <form method='POST' action= {!!url("admin/categoriaCliente/".$categoria->id.'/agregar')!!}>
                {{ csrf_field() }}
                <input type='hidden' name='id' value='{{$categoria->id}}'>

                <div class="panel-body">
                    <div class="modal-body">

                        @foreach($otros_beneficios as $beneficio)
                            <div class="row">
                                <label>{{$beneficio->nombre}}</label>
                                <input type="checkbox" value="{{$beneficio->id}}" name="beneficio[]">

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
