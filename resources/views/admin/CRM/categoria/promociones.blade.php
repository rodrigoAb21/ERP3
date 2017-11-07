@extends ('admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div>
                <a href='{!!url("admin/categoria")!!}' class='btn btn-default'><i class="fa fa-backward"></i>_Lista de
                    Categorias</a>
            </div>
            <br>
                <div class="container panel-default">
                    <div class="row">
                        <div class="col-sm-6">
                            Nombre:{{$categoria->nombre}}<br>
                            Puntos Requeridos:{{$categoria->puntosRequeridos}}
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-adn"
                                    data-toggle="modal" data-target="#myModal">AgregarPromocion
                            </button>

                            <button type="button" class="btn btn-adn"
                                    data-toggle="modal" data-target="#myModal2">QuitarPromociones
                            </button>
                        </div>
                    </div>
                </div>
            <br>
            <div class="panel panel-default" style="border-color: #00796B;border-style: solid;">
                <table class="table table-responsive table-bordered ">
                    <thead>
                    <th>Beneficio</th>
                    <th>Descripcion</th>

                    </thead>
                    <tbody>
                    @foreach ($categoria->promociones as $promocione)
                        <tr>
                            <td>{{ $promocione->nombre}}</td>
                            <td>{{ $promocione->fechaEmpieza}}</td>
                            <td>{{ $promocione->fechaTermina}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.CRM.categoria.agregarPromo')
    @include('admin.CRM.categoria.removerPromo')
@endsection