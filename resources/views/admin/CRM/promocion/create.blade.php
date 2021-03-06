@extends ('admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a href='{!!url("admin/promocion")!!}' class='btn btn-default'><i class="fa fa-backward"></i>_Lista de
                Promociones</a>
        </div>

    </div>
	<div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>{{$title}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif


            <form action="{{url('admin/promocion')}}" method="post">{{ csrf_field() }}
                <div class="form-group">
                    <label for="ci">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required autofocus>
                </div>

                <div class="form-group">
                    {{Form::label('nombre', 'Fecha Comienzo')}}
                    {{Form::date('comienzo', \Carbon\Carbon::now())}}
                </div>

                <div class="form-group">
                    {{Form::label('nombre', 'Fecha Final')}}
                    {{Form::date('final', \Carbon\Carbon::now())}}
                </div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
				</div>


            </form>
            
		</div>
	</div>
@endsection