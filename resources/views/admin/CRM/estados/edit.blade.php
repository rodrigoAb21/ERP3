@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Estado: {{$estado -> nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

            <form method="POST" action="{{url('admin/estados')}}">
                {{ csrf_field() }}{{ method_field('PUT') }}

                <input value="{{$estado->id}}" name="id" type="hidden">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{$estado -> nombre}}" required>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" name="descripcion" class="form-control" value="{{$estado -> descripcion}}">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control">
                            @if($estado -> tipo == "Seguimiento")
                                <option value="Seguimiento" selected>Seguimiento</option>
                                <option value="Tarea">Tarea</option>
                            @else
                                <option value="Tarea" selected>Tarea</option>
                                <option value="Seguimiento">Seguimiento</option>
                            @endif
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