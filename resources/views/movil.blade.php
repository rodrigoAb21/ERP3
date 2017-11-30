<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>ERP | UAGRM </title>

      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width = device-width, initial-scale = 1, maximum-scale = 1, user-scalable = no" name="viewport">

          <!-- Font Awesome -->
      <link rel="stylesheet" href="{{asset('plantilla/css/font-awesome.css')}}">

        <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="{{asset('plantilla/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('plantilla/css/bootstrap-select.min.css')}}">
      <link rel="icon" href="{{asset('favicon.ico')}}">

        <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('plantilla/css/AdminLTE.min.css')}}">

        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{asset('plantilla/css/_all-skins.min.css')}}">

      <link rel="stylesheet" href="{{asset('plantilla/css/impresora.css')}}">

      <link rel="apple-touch-icon" href="{{asset('plantilla/img/apple-touch-icon.png')}}">
    <!-- CSS para centrar todas las tablas tanto titulos como textos -->
      <style>
          th, td {
            text-align: center;
            vertical-align: middle;
          }

      </style>

  </head>
  <body class="hold-transition sidebar-mini skin-purple"
          >
  <div class="wrapper">

      <header class="main-header">


        <a href="{{asset('/admin')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-archive"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><i class="fa fa-archive"></i> PATITO </b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
            <div class="container-fluid">


                <ul class="nav navbar-nav">
                    <li><a href="#">{{Session::get('empresa')}}</a></li>
                    <li><a href="{{url('movil/login/salir')}}">Logout</a></li>
                    <li><a href="#">PuntosAcumulados:{{Session::get('puntos')}}</a></li>

                </ul>
            </div>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">

          </div>

        </nav>

      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <br>
                      <ul class="menu">
                          <li><a href="{{url('movil/promocion')}}"><i class="fa fa-arrow-right"></i>
                                  ver Promociones</a>
                          </li>
                          <li><a href="{{url('movil/carrito')}}"><i class="fa fa-arrow-right"></i>
                                  ver Carrito</a>
                          </li>
                      </ul>

          </section>
        <!-- /.sidebar -->
      </aside>


<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                          @yield('contenido')
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2013-2017 <a href="#">Sistema de Informacion II</a>.</strong> All rights reserved.
    </footer>
  </div>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plantilla/js/jquery-3.1.1.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('plantilla/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plantilla/js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('plantilla/js/app.min.js')}}"></script>

  </body>
  @stack('scripts')

</html>
