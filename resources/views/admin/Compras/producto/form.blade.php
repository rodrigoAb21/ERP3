<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    <label for="nombre" class="col-md-4 control-label">{{ 'Nombre' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="nombre" type="text" id="nombre" value="{{ $post->nombre or ''}}" required >
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('especificacion') ? 'has-error' : ''}}">
    <label for="especificacion" class="col-md-4 control-label">{{ 'Especificacion' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="especificacion" type="text" id="especificacion" required value="{{ $post->especificacion or ''}}" >
        {!! $errors->first('especificacion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('garantia') ? 'has-error' : ''}}">
    <label for="garantia" class="col-md-4 control-label">{{ 'Garantia' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="garantia" type="number" id="garantia" required value="{{ $post->garantia or ''}}" >
        {!! $errors->first('garantia', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('puntosEquivale') ? 'has-error' : ''}}">
    <label for="puntosEquivale" class="col-md-4 control-label">{{ 'Puntosequivale' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="puntosEquivale" type="number" id="puntosEquivale" required value="{{ $post->puntosEquivale or ''}}" >
        {!! $errors->first('puntosEquivale', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('puntosPorVenta') ? 'has-error' : ''}}">
    <label for="puntosPorVenta" class="col-md-4 control-label">{{ 'Puntosporventa' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="puntosPorVenta" type="number" id="puntosPorVenta" required value="{{ $post->puntosPorVenta or ''}}" >
        {!! $errors->first('puntosPorVenta', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('precioUCompra') ? 'has-error' : ''}}">
    <label for="precioUCompra" class="col-md-4 control-label">{{ 'Precioucompra' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="precioUCompra" type="number" id="precioUCompra" required value="{{ $post->precioUCompra or ''}}" >
        {!! $errors->first('precioUCompra', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('precioUVenta') ? 'has-error' : ''}}">
    <label for="precioUVenta" class="col-md-4 control-label">{{ 'Preciouventa' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="precioUVenta" type="number" id="precioUVenta" required value="{{ $post->precioUVenta or ''}}" >
        {!! $errors->first('precioUVenta', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('precioActual') ? 'has-error' : ''}}">
    <label for="precioActual" class="col-md-4 control-label">{{ 'Precioactual' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="precioActual" type="number" id="precioActual" required value="{{ $post->precioActual or ''}}" >
        {!! $errors->first('precioActual', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('categoria_id') ? 'has-error' : ''}}">
    <label for="categoria_id" class="col-md-4 control-label">{{ 'Categoria Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="categoria_id" type="number" id="categoria_id" required value="{{ $post->categoria_id or ''}}" >
        {!! $errors->first('categoria_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('visible') ? 'has-error' : ''}}">
    <label for="visible" class="col-md-4 control-label">{{ 'Visible' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="visible" type="number" id="visible" required value="{{ $post->visible or ''}}" >
        {!! $errors->first('visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
