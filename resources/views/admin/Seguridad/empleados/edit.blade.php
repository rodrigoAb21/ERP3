@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Empleado: {{$empleado -> nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
            <form method="POST" action="{{url('admin/empleados')}}">
                {{ csrf_field() }}{{ method_field('PUT') }}

        <input value="{{$empleado->id}}" name="empleado_id" type="hidden">

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="ci">CI</label>
                    <input type="text" name="ci" class="form-control" value="{{$empleado -> ci}}" required >
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" class="form-control" value="{{$empleado -> nombre}}" required>
				</div>
			</div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" name="direccion" class="form-control"  value="{{$empleado -> direccion}}" required >
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="number" name="telefono" class="form-control" value="{{$empleado -> telefono}}"  required >
                </div>
            </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <div class="form-group">
                    <label for="rol_id">Rol:</label>
                    <select name="rol_id" class="btn btn-info form-control">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}"
                                    @if($empleado->rol_id==$role->id) selected @endif>
                                {{$role->nombre}}
                            </option>
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
