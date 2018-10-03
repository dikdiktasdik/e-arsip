<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="refresh" content="900;url=<?php echo site_url('logout'); ?>" />
  <title><?php echo get_val_setting('TITLE_APPS');?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome-4.4.0/css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">

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
          Detail Arsip
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="box">
              <div class="box-body">
               <iframe src="<?php echo base_url('/assets/uploads/dokuments/'.$name_file); ?>" width="750" height="800" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->

          <div class="col-md-6">
            <div class="box">
              <div class="box-body">
                <table class="table table-bordered" style="font-size: 18px;">
                  <tr>
                    <td width="150">Nomor Surat</td>
                    <td>:</td>
                    <td><?php echo $nomor;?></td>
                  </tr>
                  <tr>
                    <td>Nama Surat</td>
                    <td>:</td>
                    <td><?php echo $title;?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Surat</td>
                    <td>:</td>
                    <td><?php echo DateToIndo($tgl_surat);?></td>
                  </tr>
                  <tr>
                    <td>Jenis Surat</td>
                    <td>:</td>
                    <td><?php echo $jenis;?></td>
                  </tr>
                  <tr>
                    <td>Lemari</td>
                    <td>:</td>
                    <td><?php echo $lemari;;?></td>
                  </tr>
                  <tr>
                    <td>Kotak</td>
                    <td>:</td>
                    <td><?php echo $kotak;?></td>
                  </tr>
                  <tr>
                    <td>Kelompok</td>
                    <td>:</td>
                    <td><?php echo $kelompok;?></td>
                  </tr>

                  <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td><?php echo $deskripsi;?></td>
                  </tr>

                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div>

      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


  </div><!-- ./wrapper -->

  <!-- jQuery 2.1.4 -->
  <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js'); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/dist/js/app.min.js'); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>
  <!-- page script -->
  <script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
  </script>
</body>
</html>
