  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UTEM | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page" background="{{asset('/dist/img/bgimage.jpg')}}">
    <div class="login-box">
      <div class="login-logo">
        <center><img  class="img-responsive" src="http://www.utem.cl/wp-content/themes/utem_05_10_16/images/01_img_cor/00_id_corp/imagotipo_utem.png" ></center>
        <a href="/"><b>S</b>ISTEMA DE <b>I</b>NVENTARIO</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese los datos para poder iniciar sesión</p>
        <form action="login/acceder" method="post">
          <div class="form-group has-feedback">
          @if(session('email'))
            <input type="text" class="form-control" name="email" placeholder="Email" required="" value="{{session('email')}}" />
          @else
            <input type="text" class="form-control" name="email" placeholder="Email" required="" />
          @endif
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="contraseña" placeholder="Contraseña" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          @if(session('error'))
            @if(session('error') == 1)
              <div class="form-group has-feedback">
                <p style="color:red">Usuario o contraseña incorrectos</p>
              </div>
            @endif
            @if(session('error') == 2)
              <div class="form-group has-feedback">
                <p style="color:red">Usuario no tiene permitido el accesso</p>
              </div>
            @endif
          @endif
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <!--<input type="checkbox"> Recordar Contraseña -->
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="{{ asset('login/correo') }}">Olvidé mi contraseña</a><br>
        <!--

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>-->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
