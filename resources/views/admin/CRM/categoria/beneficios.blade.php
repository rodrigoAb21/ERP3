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
                                    data-toggle="modal" data-target="#myModal">AgregarBeneficio
                            </button>

                            <button type="button" class="btn btn-adn"
                                    data-toggle="modal" data-target="#myModal2">QuitarBeneficios
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
                    @foreach ($categoria->beneficios as $beneficio)
                        <tr>
                            <td>{{ $beneficio->nombre}}</td>
                            <td>{{ $beneficio->descripcion}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <form method='POST' action= {!!url("admin/categoria/".$categoria->id.'/agregar')!!}>
                    <input type='hidden' name='_token' value='{{Session::token()}}'>
                    <input type='hidden' name='id' value='{{$categoria->id}}'>

                    <div class="panel-body">
                        <div class="modal-body">

                            @foreach($otros as $beneficio)
                                <div class="row">

                                    {!! Form::checkbox('beneficio[]', $beneficio->id) !!}

                                    {!! Form::label('beneficio[]', $beneficio->nombre) !!}
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class='btn btn-success' type='submit'>
                            <i class="fa fa-floppy-o"></i>Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <form method='POST' action= {!!url("admin/categoria/".$categoria->id.'/remover')!!}>
                    <input type='hidden' name='_token' value='{{Session::token()}}'>
                    <input type='hidden' name='id' value='{{$categoria->id}}'>

                    <div class="panel-body">
                        <div class="modal-body">

                            @foreach($categoria->beneficios as $beneficio)
                                <div class="row">

                                    {!! Form::checkbox('beneficio[]', $beneficio->id) !!}

                                    {!! Form::label('beneficio[]', $beneficio->nombre) !!}
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class='btn btn-success' type='submit'>
                            <i class="fa fa-floppy-o"></i>Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection