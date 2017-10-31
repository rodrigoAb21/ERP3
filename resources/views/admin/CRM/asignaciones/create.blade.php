
    <div id="modalCreate" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Tarea</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cliente">Cliente :</label>
                        <div class="col-sm-10">
                            <input type="hidden" value="{{$seguimiento->id}}" name="seguimiento">
                            <input type="text" class="form-control" readonly value="{{$seguimiento->cliente->nombre}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Ingrese el titulo" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lugar">Descripcion:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Descripcion ..." name="descripcion" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fecha">Fecha :</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="fecha" id="fecha"  value="{{$fechaActual}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="inicio">Hora :</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control"  name="inicio" id="inicio" required>
                        </div>
                        <label class="control-label col-sm-2" for="final">Hasta :</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control"  name="final" id="final" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lugar">Lugar:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Ingrese el lugar ..." name="lugar" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Crear</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>
