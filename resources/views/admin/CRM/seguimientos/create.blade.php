<div id="modalCreate" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form action="{{url('admin/seguimientos')}}" method="post">
            <div class="modal-content">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3>Nuevo Seguimiento</h3><br><h4>Fecha Apertura:<b>{{$fechaActual}}</b></h4>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Proposito</label>
                                    <textarea class="form-control" rows="5" name="proposito" type="textarea" placeholder="Ingrese el proposito del seguimiento..." ></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">

                                    <label for="cliente_id">Cliente :</label>
                                    <select name="cliente_id" class="btn btn-info form-control">
                                        @foreach($clientes as $cliente)
                                            <option value="{{$cliente->id}}">{{$cliente->nombre.' < '.$cliente->tipo.' >'}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Crear</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>