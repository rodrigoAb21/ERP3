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
  <body
          @if(Auth::user()->color == 'Morado' && Auth::user()->fondo == 'Oscuro')
            class="hold-transition sidebar-mini skin-purple"
          @elseif(Auth::user()->color == 'Morado' && Auth::user()->fondo == 'Claro')
            class="hold-transition sidebar-mini skin-purple-light"
          @elseif(Auth::user()->color == 'Negro' && Auth::user()->fondo == 'Oscuro')
            class="hold-transition sidebar-mini skin-black"
          @elseif(Auth::user()->color == 'Negro' && Auth::user()->fondo == 'Claro')
            class="hold-transition sidebar-mini skin-black-light"
          @elseif(Auth::user()->color == 'Azul' && Auth::user()->fondo == 'Oscuro')
            class="hold-transition sidebar-mini skin-blue"
          @elseif(Auth::user()->color == 'Azul' && Auth::user()->fondo == 'Claro')
            class="hold-transition sidebar-mini skin-blue-light"
          @elseif(Auth::user()->color == 'Rojo' && Auth::user()->fondo == 'Oscuro')
            class="hold-transition sidebar-mini skin-red"
          @elseif(Auth::user()->color == 'Rojo' && Auth::user()->fondo == 'Claro')
            class="hold-transition sidebar-mini skin-red-light"
          @elseif(Auth::user()->color == 'Amarillo' && Auth::user()->fondo == 'Oscuro')
            class="hold-transition sidebar-mini skin-yellow"
          @elseif(Auth::user()->color == 'Amarillo' && Auth::user()->fondo == 'Claro')
            class="hold-transition sidebar-mini skin-yellow-light"
          @elseif(Auth::user()->color == 'Verde' && Auth::user()->fondo == 'Oscuro')
            class="hold-transition sidebar-mini skin-green"
          @elseif(Auth::user()->color == 'Verde' && Auth::user()->fondo == 'Claro')
            class="hold-transition sidebar-mini skin-green-light"
          @endif

          @if(Auth::user()->fuente == 'Arial')
              style="font-family: Arial"
          @elseif(Auth::user()->fuente == 'Consolas')
          style="font-family: Consolas"
          @endif
          >
  <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{asset('/admin')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-archive"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><i class="fa fa-archive"></i> PATITO </b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                  <!-- Authentication Links -->
                  <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>
                              <ul class="dropdown-menu" role="menu" >

                                  @if(Auth::user()->tipo == 'Administrador')
                                      <li >
                                          <a href="{{asset('admin/editarPerfil/'.Auth::user() -> idEmpleado)}}" style="color: black"> Editar Perfil</a>
                                      </li>
                                      <li>
                                          <a href="{{asset('admin/editarEmpresa')}}" style="color: black"> Editar Empresa</a>
                                      </li>
                                  @endif
                                  <li>
                                        <a href="{{asset('admin/editarCuenta')}}" style="color: black"> Editar Cuenta</a>
                                  </li>
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
                  <li class="nav-item"> <a href="{{asset('/admin/editarConfig')}}"> <i class="fa fa-gears"> </i> </a> </li>
              </ul>

          </div>

        </nav>

      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
              <!-- sidebar menu: : style can be found in sidebar.less -->
              <ul class="sidebar-menu">
                  <li class="header"></li>

                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-shield"></i>
                          <span>Seguridad</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="{{asset('/admin/empleados')}}"><i class="fa fa-arrow-right"></i> Gestionar Empleados</a></li>
                          <li><a href="{{asset('/admin/cuentaEmpleados')}}"><i class="fa fa-arrow-right"></i> Gestionar Cuentas</a></li>
                         <li><a href="{{asset('/admin/casouso')}}"><i class="fa fa-arrow-right"></i> Lista de Cu </a></li>
                       <li><a href="{{asset('/admin/rol/lista-roles')}}"><i class="fa fa-arrow-right"></i> Gest. los CU de un Rol</a></li>
                          <li><a href="{{asset('/admin/rol')}}"><i class="fa fa-arrow-right"></i> Gest. Acciones Segun El Rol</a></li>
                          <li><a href="{{asset('/backup')}}"><i class="fa fa-arrow-right"></i> Backup y Restore</a></li>
                          <li><a href="{{url('/admin/bitacora')}}"><i class="fa fa-arrow-right"></i> Bitacora</a></li>

                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-shopping-cart"></i> <span>Compras</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li class="treeview">
                              <a href="#">
                                  <span>Gestion de Productos</span>
                                  <i class="fa fa-angle-left pull-right"></i>
                              </a>
                              <ul class="treeview-menu">
                                  <li><a href="{{asset('/admin/categoriaProducto')}}"><i class="fa fa-arrow-right"></i> Categorias </a></li>
                                  <li><a href="{{asset('/admin/tipos')}}"><i class="fa fa-arrow-right"></i> Tipos </a></li>
                                  <li><a href="{{asset('/admin/productos')}}"><i class="fa fa-arrow-right"></i> Productos</a></li>
                              </ul>
                          </li>
                          <li><a href="{{asset('/admin/proveedores')}}"><i class="fa fa-arrow-right"></i> Gestionar Proveedores</a></li>
                          <li><a href="{{asset('admin/notacompra')}}"><i class="fa fa-arrow-right"></i> Compras </a></li>
                          <li><a href="{{asset('admin/inventario')}}"><i class="fa fa-arrow-right"></i> Inventario </a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-money"></i> <span>Ventas</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="{{asset('/admin/pagos')}}"><i class="fa fa-arrow-right"></i> Pagos al Contado</a></li>
                          <li><a href="{{asset('/admin/creditos')}}"><i class="fa fa-arrow-right"></i> Pagos al Credito</a></li>
                          <li><a href="{{asset('/admin/clientes')}}"><i class="fa fa-arrow-right"></i> Gestionar Clientes</a></li>
                          <li><a href="{{asset('/admin/puntosVenta')}}"><i class="fa fa-arrow-right"></i> Gestionar Punto de Venta</a></li>
                          <li><a href="{{asset('/admin/garantes')}}"><i class="fa fa-arrow-right"></i> Gestionar Garantes</a></li>
                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-users"></i> <span>CRM</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="{{asset('/admin/posiblesClientes')}}"><i class="fa fa-arrow-right"></i> Gest. Posibles Clientes</a></li>
                          <li><a href="{{asset('/admin/beneficios')}}"><i class="fa fa-arrow-right"></i> Gestionar Beneficios</a></li>
                          <li><a href="{{asset('/admin/seguimientos')}}"><i class="fa fa-arrow-right"></i> Gestionar Seguimientos</a></li>
                           <li><a href="{{url('admin/categoria')}}"><i class="fa fa-arrow-right"></i> Gestionar Categoria</a></li>
                          <li><a href="{{url('admin/promocion')}}"><i class="fa fa-arrow-right"></i> Gestionar Promocion</a></li>
                      </ul>
                  </li>
                  <li class="treeview">
                      <a href="#">
                          <i class="fa fa-bar-chart"></i> <span>Reportes</span>
                          <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="{{asset('admin/reportes/ReporteVentas')}}"><i class="fa fa-arrow-right"></i> Reporte de Ventas</a></li>
                          <li><a href="{{asset('admin/reportes/ReporteStocks')}}"><i class="fa fa-arrow-right"></i> Reporte Reabastecimiento</a></li>
                      </ul>
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
