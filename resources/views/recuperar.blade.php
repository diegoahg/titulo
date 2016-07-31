<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UTEM | RECUPERAR CLAVE</title>
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
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">NUEVA CONTRASEÑA
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p>Ingrese su nueva contraseña para poder cambirla.</p>
          @if ($errors->has())
            <div class="callout callout-danger">
              <h4 class="block">Debe Completar los siguientes campos:</h4>
              <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
            </div>
          @endif
        <form action="{{ asset('login/recuperar') }}" method="post">
          <div class="form-group has-feedback">
           <input type="password" class="form-control" name="password" placeholder="Nueva Contraseña" required="" />
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Repetir Contraseña" required/>
          </div>
          <div class="row">
            <div class="col-xs-8">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_key" value="{{$id}}">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Cambiar</button>
            </div><!-- /.col -->
          </div>
        </form>
        <!--
        <a href="register.html" class="text-center">Register a new membership</a>-->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src=" plugins/iCheck/icheck.min.js')}}"></script>
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
