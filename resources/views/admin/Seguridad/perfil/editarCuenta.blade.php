@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Usuario: {{$usuario -> name}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

            {!!Form::open(array('url'=>'/admin/editarCuenta','method'=>'POST'))!!}
            {{Form::token()}}

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="color">Color Skin</label>
                    <select name="color" class="form-control">
                        <option value="{{$usuario -> color}}" selected>{{$usuario -> color}}</option>
                        @if ($usuario -> color == 'Morado')
                            <option value="Negro" >Negro</option>
                            <option value="Azul" >Azul</option>
                            <option value="Verde" >Verde</option>
                            <option value="Rojo" >Rojo</option>
                            <option value="Amarillo" >Amarillo</option>
                        @elseif ($usuario -> color == 'Azul')
                            <option value="Morado" >Morado</option>
                            <option value="Negro" >Negro</option>
                            <option value="Verde" >Verde</option>
                            <option value="Rojo" >Rojo</option>
                            <option value="Amarillo" >Amarillo</option>
                        @elseif ($usuario -> color == 'Verde')
                            <option value="Morado" >Morado</option>
                            <option value="Negro" >Negro</option>
                            <option value="Azul" >Azul</option>
                            <option value="Rojo" >Rojo</option>
                            <option value="Amarillo" >Amarillo</option>
                        @elseif ($usuario -> color == 'Rojo')
                            <option value="Morado" >Morado</option>
                            <option value="Negro" >Negro</option>
                            <option value="Azul" >Azul</option>
                            <option value="Verde" >Verde</option>
                            <option value="Amarillo" >Amarillo</option>
                        @elseif ($usuario -> color == 'Amarillo')
                            <option value="Morado" >Morado</option>
                            <option value="Negro" >Negro</option>
                            <option value="Azul" >Azul</option>
                            <option value="Verde" >Verde</option>
                            <option value="Rojo" >Rojo</option>
                        @else
                            <option value="Morado" >Morado</option>
                            <option value="Azul" >Azul</option>
                            <option value="Verde" >Verde</option>
                            <option value="Rojo" >Rojo</option>
                            <option value="Amarillo" >Amarillo</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fondo">Fondo Menu</label>
                    <select name="fondo" class="form-control">
                        @if ($usuario -> fondo == 'Oscuro')
                        <option value="{{$usuario -> fondo}}" selected>{{$usuario -> fondo}}</option>
                        <option value="Claro" >Claro</option>
                        @else
                            <option value="{{$usuario -> fondo}}" selected>{{$usuario -> fondo}}</option>
                            <option value="Oscuro" >Oscuro</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fuente">Fuente</label>
                    <select name="fuente" class="form-control">
                        @if ($usuario -> fuente == 'Default')
                            <option value="{{$usuario -> fuente}}" selected>{{$usuario -> fuente}}</option>
                            <option value="Arial" >Arial</option>
                            <option value="Consolas" >Consolas</option>
                        @elseif ($usuario -> fuente == 'Arial')
                            <option value="{{$usuario -> fuente}}" selected>{{$usuario -> fuente}}</option>
                            <option value="Default" >Default</option>
                            <option value="Consolas" >Consolas</option>
                        @elseif ($usuario -> fuente == 'Consolas')
                            <option value="{{$usuario -> fuente}}" selected>{{$usuario -> fuente}}</option>
                            <option value="Arial" >Arial</option>
                            <option value="Default" >Default</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$usuario-> email}}"  requiRojo >
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" requiRojo >
                </div>
            </div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>
			</div>


			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection