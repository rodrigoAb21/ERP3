<!DOCTYPE html>
<html lang="en">
<head>
    <title>ERP | UAGRM </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('plantilla/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/w3.css')}}">
    <link href="{{asset('fullcalendar/lib/fullcalendar.min.css')}}" rel='stylesheet' />
    <link href="{{asset('fullcalendar/fullcalendar.print.min.css')}}" rel='stylesheet' media='print' />
    <script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
    <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script>
    <script src="{{asset('fullcalendar/fullcalendar.min.js')}}"></script>

    <style>

        body {
            margin: 0px 0px;
            padding: 0;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        hr {
            display: block;
            margin-top: 1px;
            margin-bottom: 0px;
            margin-left: 1px;
            margin-right:1px;
            border-style: solid;
            border-width: 1px;
            border-color: black;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><span class="logo-lg"><b><i class="fa fa-archive"></i> PATITO </b></span></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Seguimiento al cliente <b>{{$seguimiento->cliente->nombre ."<".$seguimiento->cliente->tipo.">"}}</b></a></li>
        </ul>
        <ul class="nav navbar-nav" style="float: right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <b>{{ Auth::user()->empleado->rol->nombre.''}}</b>  {{Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" >


                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();" style="color: black">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</nav>

<div class="container">
    @include('flash::message')
    <div class="row">
        <div class="row">
            <div class="col-sm-1">
                <a href="{{url('admin/seguimientos/cliente/'.$seguimiento->cliente->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Atras</a>
            </div>
            <div class="col-sm-11">
                <h4>Proposito: <b>{{$seguimiento->proposito}}</b></h4>
            </div>
        </div>

        <div class="col-sm-9" id='calendar'></div>
        <div  class="col-sm-3" style="background-color: palegoldenrod;height: 700px">

            <div id="fechaSelecionada" style="padding: 3px">
                <h4><b>{{$fechaActual}}</b></h4>
            </div>
                <hr/>
            <div id="tareas" >

            </div>
            <button style="margin-top: 3px;float: right" type="button" class="btn btn-primary btn-md" data-toggle="modal"
                        data-target="#modalCreate"><i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <form action="{{url('admin/asignacion/'.$seguimiento->id)}}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        @include('admin.CRM.asignaciones.create')
    </form>


</div>

</body>
<script>
    var  BASEURL="{{url('admin/asignacion')}}";
    var SEGUIMIENTO="{{'/'.$seguimiento->id}}";
    var _dateSelected = document.getElementById("fechaSelecionada") ;
    var _panelTareas = document.getElementById("tareas") ;
    var _tareas="{{$seguimiento->tareas}}";
    $(document).ready(function() {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            navLinks: false, // can click day/week names to navigate views
            editable: true,
            selectable:true,
            selectHelper:true,
            select:function (date) {
                var con="";
              _date=moment(date.format());
              _tareas={!! $seguimiento->tareas !!};
                _dateSelected.innerHTML = _date.format('YYYY-MM-DD');
                _tareas.forEach(function (valor, indice, array) {
                    if(valor.pivot.fecha==_date.format('YYYY-MM-DD')) {

                        con=con+"<div class=\"w3-" +valor.color+
                            " w3-hover-shadow\" style=\"width:100%; height: 80px;margin-top: 10px\">" +
                            "<p style=\"float: left;margin-top: 5px;margin-left: 5px;margin-bottom: 0px\">Titulo: <b style=\"font-size: medium\">"+valor.nombre+"</b></p>" +
                            "<a  href=\" "+
                            BASEURL+"/destroy/"+valor.id+SEGUIMIENTO+
                        "\" style=\"float: right; margin-bottom: 1px\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash-o fa-lg\"></i></a>"+
                            "<p style=\"float: left;margin-top: 0px;margin-left: 5px;margin-bottom: 0px\">Hora: <b style=\"font-size: smaller\">"+valor.pivot.hora_inicio+" hasta "+valor.pivot.hora_final+"</b> </p>"+
                            "<p style=\"float: left;margin-top: 0px;margin-left: 5px;margin-bottom: 0px\">Lugar: <b style=\"font-size: smaller\">"+valor.pivot.nota+"</b> </p>"+
                            "</div>";
                    }
                });
                _panelTareas.innerHTML=con;
            },
            events:{!! $tareas !!},
            eventClick: function(event, jsEvent, view) {

                alert('Titulo de la tarea: '+event.title );


            },
        });
        document.getElementById("fecha").addEventListener("change", checkFecha);
        function checkFecha() {
            var x = document.getElementById("fecha");
            if(x.value<"{{$fechaActual}}")
            {
                alert(x.value+" La fecha no puede ser anterior a la fecha actual !!");
                x.value="{{$fechaActual}}";
            }


        }

        document.getElementById("final").addEventListener("change", checkHoraFinal);
        function checkHoraFinal() {
            var inicio = document.getElementById("inicio");
            var final = document.getElementById("final");
            if(final.value< inicio.value)
            {
                alert(final.value+" La hora final no puede ser anterior a la hora inicial !!");
                final.value=inicio.value;
            }
        }
    });


</script>
</html>
