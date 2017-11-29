@extends ('admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Pago al Credito</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

			{!!Form::open(array('url'=>'admin/creditos','method'=>'POST','autocomplete'=>'off', 'files'=>'true'))!!}
            {{Form::token()}}
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="nit">NIT</label>
                <input type="number" min="0" name="nit" class="form-control" autofocus>
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
                <label for="nroCuotas">Nro de Cuotas</label>
                <input type="number" min="1" name="nroCuotas" id="nroCuotas" class="form-control" required >
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="plazo">Plazo</label>
                <input type="date" name="plazo" class="form-control" required>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="interes">Interes (%)</label>
                <input type="text" name="interes" id="interes" class="form-control" required >
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="montoCuota">Monto de Cuotas</label>
                <input type="text" name="montoCuota" id="montoCuota" class="form-control" disabled>
                <input type="hidden" name="montoCuota2" id="montoCuota2" class="form-control">
            </div>
        </div>

        <input type="hidden" name="t2" id="t2" class="form-control">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="t">Total a Pagar</label>
                <input type="text" name="t" id="t" class="form-control" disabled>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Punto de Venta</label>
                <select name="idPuntoVenta" class="form-control selectpicker" data-live-search="true">
                    @foreach ($punto as $punt)
                       <option value="{{$punt -> id}}">{{$punt -> nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Cliente</label>
                <select id="idCliente"  name="idCliente"  class="form-control selectpicker"  data-size="6" data-live-search="true">
                    @foreach ($cliente as $cli)
                        <option value="{{$cli -> id}}">{{$cli -> nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
        <div class="row content">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3>Datos Garante 1</h3>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g1ci">Nro de Carnet</label>
                        <input type="text" name="g1ci" class="form-control" required >
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g1nombre">Nombre</label>
                        <input type="text" name="g1nombre" class="form-control" required >
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g1telefono">Telefono</label>
                        <input type="number" name="g1telefono" class="form-control" required >
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g1direccion">Direccion</label>
                        <input type="text" name="g1direccion" class="form-control" required >
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g1documento">Documento</label>
                        <input type="file" name="g1documento" class="form-control" required >
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3>Datos Garante 2</h3>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g2ci">Nro de Carnet</label>
                        <input type="text" name="g2ci" class="form-control" required >
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g2nombre">Nombre</label>
                        <input type="text" name="g2nombre" class="form-control" required >
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g2telefono">Telefono</label>
                        <input type="number" name="g2telefono" class="form-control" required >
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g2direccion">Direccion</label>
                        <input type="text" name="g2direccion" class="form-control" required >
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="g2documento">Documento</label>
                        <input type="file" name="g2documento" class="form-control" required >
                    </div>
                </div>
            </div>
        </div>


    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                    <div class="form-group">
                        <label>Productos</label>
                        <select name="idProducto" class="form-control selectpicker" id="idProducto" data-live-search="true" data-size="6">
                            @foreach($producto as $pro)
                            <option value="{{$pro -> id}}_{{$pro -> precioActual}}">{{$pro -> nombre}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label for="cant">Cantidad</label>
                        <input type="number" min="1" name="cant" id="cant" class="form-control" >
                        
                    </div>
                </div>
                
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="text" name="precio" id="precio" class="form-control" disabled>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>

                <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="detalle2" class="table table-responsive table-striped table-bordered table-hover">
                        <thead style="background-color: #A9D0F5">
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Sub Total</th>
                        </thead>
                        <tbody id="detalle">

                        </tbody>
                        <tfoot>
                        <tr>
                            <th><h3>TOTAL</h3></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h3 id="total_precio">Bs. 0.00</h3><input type="hidden" name="total_precio" id="total_precio"></th>
                        </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
           <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div> 
        </div>
            
    </div>
        
			{!!Form::close()!!}
    @push('scripts')
    <script>
        $(document).ready(
            function () {
                mostrarPrecio();
                mostrarTotal();
                evaluar();
                $('#bt_add').click(
                    function () {
                        agregar();
                        evaluar();
                    }
                );
            }
        );

        var cont = 0;
        var total = 0;
        var subTotal = [];

        var interes = 0.0;
        var nroCuota = 0;
        var cuota = 0.0;


        var tt = 0;

        function mostrarPrecio() {
            datosProducto = document.getElementById('idProducto').value.split('_');
            $('#precio').val(datosProducto[1]);
        }

        $('#idProducto').change(mostrarPrecio);

        function mostrarTotal() {

            $("#stotal").html("Bs." + total);
            $("#total_precio").html("Bs." + total);//  html porq es un h4

        }


        $('#nroCuotas').on('input',function () {
            calCuota();
        });

        $('#interes').on('input',function () {
            calCuota();
        });



        function calCuota() {
            interes = $('#interes').val();
            nroCuota = $('#nroCuotas').val();
            cuota = (total/nroCuota) + (total * interes/100);
            $("#montoCuota").val(cuota.toFixed(2));
            $("#montoCuota2").val(cuota.toFixed(2));
            tt = nroCuota * cuota;
            $('#t').val(tt.toFixed(2));
            $('#t2').val(tt.toFixed(2));

        }

        function agregar() {
            datosProducto = document.getElementById('idProducto').value.split('_');
            idProductoT = datosProducto[0];
            nombreProducto = $('#idProducto option:selected').text();
            cantidad = $('#cant').val();
            precio = $('#precio').val();

            if (idProductoT != "" && cantidad != "" && cantidad > 0) {
                subTotal[cont] = (cantidad * precio);
                total = total + subTotal[cont];


                var fila='<tr id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-remove" aria-hidden="true"></i></button></td><td><input type="hidden" name="idProductoT[]" value="'+idProductoT+'">'+nombreProducto+'</td><td><input type="hidden" name="cantidadTabla[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="precioTabla[]" value="'+precio+'">'+precio+'</td><td><input type = "hidden" name = "subTotal[]" value = "'+subTotal[cont]+'" >'+subTotal[cont]+'</td> </tr>';

                cont++;
                limpiar();
                total.toPrecision(2);
                $("#stotal").html("Bs." + total);
                $("#total_precio").html("Bs." + total);//  html porq es un h4
                $("#detalle").append(fila); // sirve para anhadir una fila a los detalles
                calCuota();
            }

        }

        function limpiar(){
            $("#cant").val("");
        }

        function eliminar(index){
            total = total - subTotal[index];
            $("#stotal").html("Bs. "+total);
            $("#total_precio").html("Bs. "+total);
            $("#total_precio").val(total);

            cont--;

            $("#fila" + index).remove();
            evaluar();
        }

        function evaluar(){
            if (cont > 0) {
                $("#guardar").show();
            }else{
                $("#guardar").hide();
            }
        }

    </script>
    @endpush
@endsection
