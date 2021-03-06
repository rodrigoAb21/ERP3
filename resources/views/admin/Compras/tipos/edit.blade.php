@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Tipo: {{$tipo -> nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

            <form method="POST" action="{{url('admin/tipos')}}">
                {{ csrf_field() }}{{ method_field('PUT') }}

                <input value="{{$tipo->id}}" name="id" type="hidden">


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{$tipo -> nombre}}"  required >
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Categoria</label>
                    <select name="idCategoriaProd" class="form-control selectpicker" data-live-search="true">
                        @foreach ($categoria as $cat)
                            @if($cat -> id == $tipo->idCategoriaProd)
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