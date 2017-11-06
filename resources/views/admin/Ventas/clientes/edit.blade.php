@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Lote: {{$cliente -> nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

            <form method="POST" action="{{url('admin/clientes')}}">
                {{ csrf_field() }}{{ method_field('PUT') }}

                <input value="{{$cliente->id}}" name="id" type="hidden">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="ci">Nro de Carnet</label>
                        <input type="text" name="ci" class="form-control" value="{{$cliente -> ci}}"  required >
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{$cliente -> nombre}}"  required >
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" class="form-control" value="{{$cliente -> direccion}}"   >
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="number" name="telefono" class="form-control" value="{{$cliente -> telefono}}"     >
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$cliente -> email}}"   >
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Categoria</label>
                        <select name="idCategoria" class="form-control selectpicker" data-live-search="true">
                            @foreach ($categoria as $cat)
                                @if($cat -> id == $cliente->idCategoria)
                                    <option value="{{$cat -> id}}" selected>{{$cat -> nombre}}</option>
                                @else
                                    <option value="{{$cat -> id}}">{{$cat -> nombre}}</option>
                                @endif
                            @endforeach
                        </select>
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