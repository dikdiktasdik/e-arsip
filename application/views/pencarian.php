<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo get_val_setting('TITLE_APPS');?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome-4.4.0/css/font-awesome.min.css');?>">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition sidebar-collapse  lockscreen">
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <?php echo get_val_setting('APPS_VERSION');?>
    </div>

        <form class="form">
          <div class="input-group input-group-lg">
            <input type="text" class="form-control input-lg">
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-flat">Go!</button>
            </span>
          </div>
        </form>
        <div class="help-block text-center">
          &nbsp;
        </div>

        <div class="text-center">
          <a href="<?php echo site_url('login');?>">Masuk Sebagai Pengguna</a>
        </div>

    <br/>
    <div class="lockscreen-footer text-center"><?php echo get_val_setting('COPYRIGHT');?></div>
  </div><!-- /.center -->

  <!-- jQuery 2.1.4 -->
  <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
</body>
</html>
