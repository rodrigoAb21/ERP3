@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Producto: {{$producto -> nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

            <form method="POST" action="{{url('admin/productos')}}" enctype="multipart/form-data">
                {{ csrf_field() }}{{ method_field('PUT') }}

                <input value="{{$producto->id}}" name="id" type="hidden">


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{$producto -> nombre}}"  required >
                </div>
            </div>


                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="especificacion">Especificacion</label>
                        <input type="text" name="especificacion" class="form-control" value="{{$producto -> especificacion}}"   required >
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="garantia">Garantia (Meses)</label>
                        <input type="number" name="garantia" class="form-control" value="{{$producto -> garantia}}"   required >
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="puntosEquivale">Puntos Equivale</label>
                        <input type="number" name="puntosEquivale" class="form-control" value="{{$producto -> puntosEquivale}}"   required >
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="puntosPorVenta">Puntos por Venta</label>
                        <input type="number" name="puntosPorVenta" class="form-control" value="{{$producto -> puntosPorVenta}}"   required >
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo_id" class="form-control selectpicker" data-live-search="true">
                            @foreach ($tipo as $tip)
                                @if($tip -> id == $producto->tipo_id)
                                    <option value="{{$tip -> id}}" selected>{{$tip -> nombre}}</option>
                                @else
                                    <option value="{{$tip -> id}}">{{$tip -> nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control"  value="{{$producto -> imagen}}">
                    @if (($producto -> imagen)!="")
                        <img src="{{asset('img/productos/'.$producto -> imagen)}}" height="150px" width="150px" class="img-thumbnail"  >
                    @endif
                    </div>
                </div>


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
            </div>

			</form>
            
		</div>
	</div>
@endsection