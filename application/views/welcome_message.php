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
  <!-- Ionicons
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">

  <link href="<?php echo base_url('assets/plugins/fullcalendar/fullcalendar.css'); ?>" rel="stylesheet"/>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php get_header(); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>Dashboard</h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php echo show_messaga_dialog(); ?>
        <div class="row">
          <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-gears"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number" id="cpu_traffic"><?php echo implode(' ', get_server_load()); ?> <small>%</small></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div>
          <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-book"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">ARSIP</span>
                <span class="info-box-number"><?php //echo count_arsip();?></span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-xs-4">
            <div class="box box-primary">
              <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Calendar</h3>
              </div><!-- /.box-header -->
              <div class="box-body" style="font-size: 11px; margin: 5px;">
                <div id="calendar"></div>
              </div>
            </div>
          </div>

          <!-- Modal Form Quick -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="#" method="post" id="frm_quick_todo">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Quick to do <img id="loading_form_submit" src="<?php echo base_url('assets/img/ajax-loader.gif'); ?>"></h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <input type="text" class="form-control" name="title" placeholder="Title to do">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>


          <!-- Modal Due Date -->
          <div class="modal fade" id="modal_due_date" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Data tasks due date </h4>
                </div>
                <div class="modal-body">
                  <ul class="todo-list" id="tasks_due_date_lists">
                    <center><img id="loading_due_date" src="<?php echo base_url('assets/img/ajax-loader-big.gif'); ?>"></center>
                  </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  <!--button type="submit" class="btn btn-primary">Save</button-->
                </div>
              </div>
            </div>
          </div>

          <!-- Detail Tasks -->
          <div class="modal fade" id="modal_detail_task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Reminder Info</h4>
                </div>
                <div class="modal-body">
                  <div id="data_detail_task"></div>
                  <center><img id="loading_detail_task" src="<?php echo base_url('assets/img/ajax-loader-big.gif'); ?>"></center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" onclick="javascript: do_it();" class="btn btn-primary">Do it</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Detail Tasks -->
          <div class="modal fade" id="modal_do_task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Reminder Info</h4>
                </div>
                <div class="modal-body">
                  <div id="data_do_task"></div>
                  <center><img id="loading_do_task" src="<?php echo base_url('assets/img/ajax-loader-big.gif'); ?>"></center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-info" onclick="alert('Update Status')" data-dismiss="modal">OK</button>
                </div>
              </div>
            </div>
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->

    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/plugins/fullcalendar/lib/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/fullcalendar/fullcalendar.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/fullcalendar/fullcalendar.min.js'); ?>"></script>


    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url('assets/plugins/morris/morris.min.js'); ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/app.min.js'); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>

    <script>

    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      //bootstrap WYSIHTML5 - text editor

      $('#loading_form_submit').hide();
      $('#loading_due_date').hide();
      $('#loading_data_todos').hide();
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,basicWeek,basicDay'
        },
        events: '<?php echo site_url('tasks/get_load_data_duedate_calendar'); ?>',
        editable: true,
        //eventLimit: true,
        eventDrop: function (event, delta) {
          alert(event.title + ' was moved ' + delta + ' days\n' +
          '(should probably update your database)');
        }
      });

      function cpu_traffic() {
        $.get('<?php echo site_url('welcome/cpu_traffic'); ?>', function (data) {
          $('#cpu_traffic').html('');
          $('#cpu_traffic').html(data);
        });
      }

      //load data todo every 10second
      setInterval(function () {
        //load_do_task();
        load_data();
        cpu_traffic();
      }, 20000);

    });
  </script>
</body>
</html>
