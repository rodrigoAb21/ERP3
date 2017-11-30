<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">

    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="{{url('movil/cliente/registro')}}">Registro</a></li>
            <li><a href="{{url('movil/login')}}">Ingresar</a></li>
        </ul>

        {{$empresaSeleccionada=Session::get('empresa_id')}}
        <select id="empresa" name="empresa" class="nav navbar-nav navbar-right" onchange="guardarEmpresa()">
            @foreach($empresas as $empresa)
                <option @if($empresaSeleccionada==$empresa->id) selected  @endif
                value="{{$empresa->id}}"> {{$empresa->nombre}}</option>
            @endforeach
        </select>

    </div>
</nav>

<div class="container">
	<div class="row ">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Nuevo Cliente</h3>

			{!!Form::open(array('url'=>'movil/cliente/store','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="ci">Nro de Carnet</label>
                    <input type="text" name="ci" class="form-control" required >
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required >
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" name="direccion" class="form-control"  >
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="number" name="telefono" class="form-control">
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control"  >
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
</div>

</body>
<script>
    var URL_BASE="{!! url('movil') !!}";
    function guardarEmpresa() {

        var empresa = document.getElementById("empresa");
        var idEmpresa = empresa.options[empresa.selectedIndex].value;
        //alert(idEmpresa);
       window.location.href = URL_BASE+'/login/empresa/'+idEmpresa;
    }
</script>
</html>