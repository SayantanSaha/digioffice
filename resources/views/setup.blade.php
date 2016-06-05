<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DigiOffice | Setup </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Digi</b>Office</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Setup DigiOffice</p>

    <form action="/office" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Name of Office" name="name">        
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Name of Office in Local Language" name="nameLocal">        
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Name of District" name="district">        
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Name of District in Local Language" name="districtLocal">        
      </div>
	  <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Name of Subdivision" name="subdivision">        
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Name of Subdivision in Local Language" name="subdivisionLocal">        
      </div>
	  <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Name of Circle" name="circle">        
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Name of Circle in Local Language" name="circleLocal">        
      </div>
	  <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Head of Office" name="head">        
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Head of Office in Local Language" name="headLocal">        
      </div>
	  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   

    
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->
<script src="/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/plugins/iCheck/icheck.min.js"></script>
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
