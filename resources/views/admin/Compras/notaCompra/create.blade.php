@extends ('admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <h3>Nueva Compra</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            {{--<form action="{{url('admin/notacompra')}}" method="post" class="form-inline">{{ csrf_field() }}--}}

                @include('admin.Compras.notaCompra.header')
                <br>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                        <label for="producto">Seleccione el producto:</label><br>
                        <select id="producto" name="producto" class="btn btn-default form-control">
                            @foreach($productos as $producto)
                                <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label><br>
                        <input id="cantidad" style="width: 70px" type="number" name="cantidad" value="0"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label for="precioU">Precio (U):</label><br>
                        <input id="precioU" type="number" name="precioU" value="0"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                        <label for="subtotal">SubTotal ($):</label><br>
                        <input id="subtotal" type="number" name="subtotal" value="0" class="form-control">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><BR>
                    <button type="button" onclick="agregarProducto()" class="btn btn-sm btn-warning">AgregarACompra
                    </button>

                </div>

        </div>
    </div>
    <table class="table table-striped table-condensed table-hover table-bordered">

        <br>
        <thead>
        <th>#</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio (U)</th>
        <th>SubTotal ($)</th>
        <th>Opciones</th>
        </thead>
        <tbody id="productosSeleccionados">
            {{--<tr id="fila1">
                <td>1</td>
                <td>CocaCola 0</td>
                <td>500</td>
                <td>10</td>
                <td>5000</td>
                <td>
                    <a href='#' onclick="removerProducto('fila1')" class="btn btn-info">Quitar</a>
                </td>
            </tr>--}}
        </tbody>
    </table>
@endsection

@push('scripts')
<script type="text/javascript">
    var url="{{ url('admin/notacompra/store')}}";
    var productos = [];
    var selectProducto=document.getElementById("producto");
    var selectProveedor=document.getElementById("proveedor");
    var inputCantidad=document.getElementById("cantidad");
    var inputPrecioU=document.getElementById("precioU");
    var inputSubtotal=document.getElementById("subtotal");
    document.getElementById("cantidad").addEventListener("change", calcularSubtotal);
    document.getElementById("precioU").addEventListener("change", calcularSubtotal);

    function agregarProducto() {
        productos.push([
            selectProducto.options[selectProducto.selectedIndex].value,
            selectProducto.options[selectProducto.selectedIndex].text,
            inputCantidad.value,
            inputPrecioU.value,
            inputSubtotal.value
        ]);
       mostrarProductos();
    }
    function mostrarProductos() {
        HTML="";
        productos.forEach( function(producto, indice, array) {
            HTML =HTML+ "<tr id=\""+indice+"\"> <td>"+indice+"</td> <td>"+producto[1]+"</td> " +
                    "<td>"+producto[2]+"</td> <td>"+producto[3]+"</td> <td>"+producto[4]+"</td>" +
                    "<td> <a href='#' onclick=\"removerProducto('" + indice +"')\" class=\"btn btn-info\">Quitar</a>" +
            " </td> </tr>";
        });
        document.getElementById("productosSeleccionados").innerHTML = HTML;
    }
    function removerProducto(fila) {
        alert(fila);
        delete productos[fila];
        document.getElementById(fila).innerHTML = "";
    }
    function calcularSubtotal() {
        cantidad = document.getElementById("cantidad").value;
        precioU = document.getElementById("precioU").value;
        subtotal = cantidad * precioU;
        document.getElementById("subtotal").value = subtotal;
    }
    function gotoController() {
        fecha = document.getElementById("fecha").value;
        proveedor= selectProveedor.options[selectProveedor.selectedIndex].value;
       window.location=this.url+'?r='+JSON.stringify(productos)+'&p='+proveedor+'&f='+fecha+'&';
    }

</script>
@endpush