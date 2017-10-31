@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


			<h3>Copia de Seguridad y Restauracion de Base de Datos</h3>


			<p>Desde esta vista usted puede realizar una copia de seguridad de su sistema y restaurar a un punto anterior</p>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-group">
					<hr/>
					<label for="backup">Realizar Copia de Seguridad de la Base de Datos</label>
					<a href="{{URL::action('backupController@backup')}}"> <Button type="button" class="btn btn-primary">Realizar</Button>  </a>

				</div>
			</div>




			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-group">
					<hr/>
					<label for="backup">Restaurar Base de Datos</label>
					<a href="{{URL::action('backupController@restaurar')}}"> <Button class="btn btn-danger">Restaurar</Button>  </a>
					{{--  <button class="btn btn-primary" type="button">Realizar</button>  --}}

				</div>
			</div>



		</div>
	</div>