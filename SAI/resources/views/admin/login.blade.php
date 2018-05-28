<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Indatech C.A. | Admin</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="/adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/adminLTE/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="/adminLTE/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/adminLTE/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/adminLTE/css/skins/_all-skins.min.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="/adminLTE/bower_components/morris.js/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="/adminLTE/bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="/adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="/adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


        <link rel="stylesheet" href="/plugins/css/validarInput.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/adminLTE/index2.html"><b>Indatech C.A.</b> | Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicio de sesión</p>

    <!--<form action="/adminLTE/index2.html" method="post">-->
    {!! Form::open(['route' => 'users.login', 'method' => 'POST' ]) !!}
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    <!--</form>-->
    {!! Form::close() !!}

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
          <script src="/adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
          <!-- jQuery UI 1.11.4 -->
          <script src="/adminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>
          <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
          <script>
            $.widget.bridge('uibutton', $.ui.button);
          </script>
          <!-- Bootstrap 3.3.7 -->
          <script src="/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
          <!-- Morris.js charts -->
          <script src="/adminLTE/bower_components/raphael/raphael.min.js"></script>
          <script src="/adminLTE/bower_components/morris.js/morris.min.js"></script>
          <!-- Sparkline -->
          <script src="/adminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
          <!-- jvectormap -->
          <script src="/adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
          <script src="/adminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
          <!-- jQuery Knob Chart -->
          <script src="/adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
          <!-- daterangepicker -->
          <script src="/adminLTE/bower_components/moment/min/moment.min.js"></script>
          <script src="/adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
          <!-- datepicker -->
          <script src="/adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
          <!-- Bootstrap WYSIHTML5 -->
          <script src="/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
          <!-- Slimscroll -->
          <script src="/adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
          <!-- FastClick -->
          <script src="/adminLTE/bower_components/fastclick/lib/fastclick.js"></script>
          <!-- AdminLTE App -->
          <script src="/adminLTE/js/adminlte.min.js"></script>
          <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
          <script src="/adminLTE/js/pages/dashboard.js"></script>
          <!-- AdminLTE for demo purposes -->
          <script src="/adminLTE/js/demo.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
