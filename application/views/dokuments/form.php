<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="refresh" content="900;url=<?php echo site_url('logout'); ?>" />
  <title><?php echo get_val_setting('TITLE_APPS'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome-4.4.0/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php get_header() ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Form Arsip
          <small></small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php echo show_messaga_dialog();?>
        <div class="row">
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-body">
                <?php echo form_open_multipart($form_action); ?>
                <div class="box-body">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="form-group">
                        <label>Nomor</label>
                        <?php echo form_input($nomor);?>
                      </div>
                      <div class="form-group">
                        <label>Title</label>
                        <?php echo form_input($title);?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-3">
                        <div class="form-group">
                          <label>Jenis</label>
                          <?php echo $jenis;?>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Kelompok</label>
                          <?php echo $kelompok_id;?>
                        </div>
                      </div>
                      <div class="col-xs-3">
                        <div class="form-group">
                          <label>Tanggal Surat</label>
                          <?php echo form_input($tgl_surat);?>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Lemari</label>
                          <?php echo $kode_lemari;?>
                        </div>
                      </div>

                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Kotak</label>
                          <?php echo $kode_kotak;?>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <?php echo form_textarea($deskripsi);?>
                      </div>
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="userfile" size="1024" required="required">
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <button class="btn btn-primary" type="submit">Save</button>
                  <a href="<?php echo site_url('arsips');?>" class="btn btn-danger">Back</a>
                </div>
              </form>
            </div><!-- /.box-body -->
          </div><!-- /. box -->
        </div><!-- /.col -->
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/app.min.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>
<!-- page script -->
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
<script>
$(function () {
  $(".select2").select2();
  // Replace the <textarea id="editor1"> with a CKEditor
  //bootstrap WYSIHTML5 - text editor
  $(".textarea").wysihtml5({
    "html": true,
  });

  $('#tgl_surat').datepicker({
    format: 'yyyy-mm-dd'
  });

});
</script>
</body>
</html>
