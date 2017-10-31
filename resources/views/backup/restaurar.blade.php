@extends('admin')

@section('contenido')

    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" >Lista de Backups</div>
                    <div class="panel-body">


                        <table style="width:100%" >
                            <tr>
                                <th>Descripcion</th>
                                <th>Seleccionar</th>

                            </tr>
                            @foreach($backups as $backup)
                                <tr>
                                    <td>{{$backup->nombre}}</td>
                                    <td><a href="{{URL::action('backupController@save',$backup->id)}}" class="btn btn-primary">Seleccionar</a></td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">

                            </div>
                        </div>

                        </form>
                                </div>
                </div>
            </div>
            {{--  <a href="{{URL::action('backupController@index')}}" class="btn btn-primary">Cancelar</a>  --}}
        </div>
    </div>