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
			<h3>Editar Promocion</h3>
            <form action="{{url('admin/promocion/update')}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" value="{{$promocion->id}}" name="id">
                <div class="form-group">
                    <label for="ci">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{$promocion->nombre}}">
                </div>

                <div class="form-group">
                    <label class="form-control" for="comienzo">Fecha Inicio</label>
                    <input type="date" value="{{$promocion->fechaEmpieza}}" name="comienzo">
                </div>

                <div class="form-group">
                    <label class="form-control" for="final">Fecha Final</label>
                    <input type="date" value="{{$promocion->fechaTermina}}" name="final">
                </div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">Actualizar</button>
				</div>


            </form>
            
		</div>
	</div>
@endsection