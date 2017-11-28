<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <div class="form-group">
            <label for="fecha">Fecha de Registro:</label><br>
            <input id="fecha" class="form-control" type="date" name="fecha" value="{{ $fechaActual}}">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <div class="form-group">
            <label for="proveedor">Seleccione el proveedor:</label><br>
            <select id="proveedor" name="proveedor" class="btn btn-default form-control">
                @foreach($proveedores as $proveedore)
                <option value="{{$proveedore->id}}">{{$proveedore->nombre}}</option>
                    @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <button onclick="gotoController()"  type="submit" class="btn btn-md btn-primary"> Guardar y Abastecer</button>
    </div>
</div>