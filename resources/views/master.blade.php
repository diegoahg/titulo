<?php $auth_user = Auth::user();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UTEM| Inventario</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('/plugins/select2/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('/dist/css/skins/_all-skins.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/plugins/iCheck/flat/blue.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('/plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">  
    <style type="text/css" media="screen">input {text-transform:uppercase;} </style>

     <style type="text/css">
     
.typeahead,
.tt-query,
.tt-hint {
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
}

.typeahead {
  background-color: #fff;
}

.typeahead:focus {
  border: 2px solid #0097cf;
}

.tt-query {
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.tt-hint {
  color: #999
}

.tt-menu {
  width: 100%;
  margin: 12px 0;
  padding: 8px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.2);
}

.tt-suggestion {
  padding: 3px 20px;
  font-size: 18px;
  line-height: 24px;
}

.tt-suggestion:hover {
  cursor: pointer;
  color: #fff;
  background-color: #0097cf;
}

.tt-suggestion.tt-cursor {
  color: #fff;
  background-color: #0097cf;

}

.tt-suggestion p {
  margin: 0;
}

    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>U</b>TEM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>U</b>TEM</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!--<img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                  <span class="hidden-xs">{{$auth_user->name}} {{$auth_user->apellido_paterno}} {{$auth_user->apellido_materno}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <!--<img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                    <p>
                      {{$auth_user->name}} - {{$auth_user->cargo}}
                      <small>Miembro desde {{$auth_user->created_at}}</small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{asset('login/logout')}}" class="btn btn-default btn-flat">Desconectar</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button 
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!--<div class="user-panel">
            <div class="pull-left image">
              <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Usuario</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>-->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Barra de Navegación</li>
            <li  id="main" class="treeview">
              <a href="{{ asset('/') }}">
                <i class="fa fa-home"></i> <span>Home</span>
              </a>
            </li>
            @if($auth_user->permisos<=3)
            <li  id="usuarios"  class="treeview">
              <a href="{{ asset('usuarios') }}">
                <i class="fa fa-user"></i> <span>Usuarios</span>
              </a>
            </li>
            @endif
            <!--<li id="productos" class="treeview">
              <a href="/productos">
                <i class="fa fa-cube"></i> <span>Productos</span>
              </a>
            </li>-->
            @if($auth_user->permisos<=5)
             <li  id="inventario" class="treeview">
              <a href="#">
                <i class="fa fa-cubes"></i>
                <span>Inventario</span>
              </a>
              <ul class="treeview-menu">
                <li  id="bien-activo"><a href="{{ asset('bien-activo') }}"><i class="fa fa-circle-o"></i> Bienes de Activo</a></li>
                <li  id="bien-registro"><a href="{{ asset('bien-registro') }}"><i class="fa fa-circle-o"></i> Bienes de Registro</a></li>
                <li  id="bien-licencia"><a href="{{ asset('bien-licencia') }}"><i class="fa fa-circle-o"></i> Licencias de Software</a></li>
                <li  id="bien-raiz"><a href="{{ asset('bien-raiz') }}"><i class="fa fa-circle-o"></i> Bienes Raices</a></li>
              </ul>
            </li>
            @endif
            @if($auth_user->permisos<=2)
            <li id="categorias" class="treeview">
              <a href="{{ asset('categorias') }}">
                <i class="fa fa-bars"></i>
                <span>Categorias</span>
              </a>
            </li>
            @endif
            @if($auth_user->permisos<=2)
            <li id="centrocosto" class="treeview">
              <a href="{{ asset('centrocosto') }}">
                <i class="fa fa-institution "></i>
                <span>Centros de Costo</span>
              </a>
            </li>
            @endif
            @if($auth_user->permisos<=2)
            <li id="sector" class="treeview">
              <a href="{{ asset('sector') }}">
                <i class="fa fa-building"></i>
                <span>Sector</span>
              </a>
            </li>
            @endif
            @if($auth_user->permisos<=2)
            <li id="cuentacontable" class="treeview">
              <a href="{{ asset('cuentacontable') }}">
                <i class="fa fa-creative-commons"></i>
                <span>Cuenta Contable</span>
              </a>
            </li>
            @endif
            @if($auth_user->permisos<=4)
            <li  id="reportes" class="treeview">
              <a href="#">
                <i class="fa fa-line-chart"></i>
                <span>Reportes</span>
              </a>
              <ul class="treeview-menu">
                <li  id="reporte-inventario"><a href="{{ asset('reporte-inventario') }}"><i class="fa fa-circle-o"></i> Reporte Inventario</a></li>
              </ul>
              <ul class="treeview-menu">
                <li  id="reporte-valorizacion"><a href="{{ asset('reporte-valorizacion') }}"><i class="fa fa-circle-o"></i> Reporte Valorización</a></li>
              </ul>
              <ul class="treeview-menu">
                <li  id="reporte-vida-util"><a href="{{ asset('reporte-vida-util') }}"><i class="fa fa-circle-o"></i> Reporte Vida Útil</a></li>
              </ul>
              <!--<ul class="treeview-menu">
                <li  id="logs"><a href="{{ asset('logs') }}"><i class="fa fa-circle-o"></i> Logs de Usuario</a></li>
              </ul>-->

            </li>
            @endif
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      @yield('contenido')

      
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://www.utem.cl">UTEM</a>.</strong> Trabajo de Titulo del Estudiante Diego Hernández García y Profesor Mauro Castillo Valdés
      </footer>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
     <!-- Select2 -->
    <script src="{{asset('/plugins/select2/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('/plugins/knob/jquery.knob.js')}}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{asset('/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/dist/js/app.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('/dist/js/demo.js')}}"></script>
    <script src="{{asset('/plugins/typehead/typeahead.bundle.js')}}"></script>


    @section('script')      
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('/dist/js/pages/dashboard.js')}}"></script>
    @show
  </body>
</html>

