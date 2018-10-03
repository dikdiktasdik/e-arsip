<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url(''); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels
        <span class="logo-mini"><b>A</b>LT</span -->
        <!-- logo for regular state and mobile devices -->
        <div class="logo-lg">
            <?php echo get_val_setting('APPS_VERSION'); ?>
        </div>
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
                        <img src="<?php echo base_url('assets/dist/img/avatar5.png'); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo get_session_name('fullname'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url('assets/dist/img/avatar5.png'); ?>" class="img-circle" alt="User Image">
                            <p>
                                <?php echo get_session_name('fullname'); ?>
                                <small><?php //echo member_since(); ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo site_url('logout'); ?>" class="btn btn-danger btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/dist/img/avatar5.png'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo get_session_name('fullname'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->

        <!-- ADMIN -->

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?php echo site_url(''); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-navicon"></i> <span>e-Arsip</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('dokuments/tambah'); ?>"><i class="fa fa-pencil-square-o"></i> Tambah Arsip</a></li>
                    <li><a href="<?php echo site_url('dokuments'); ?>"><i class="fa fa-list-alt"></i> Daftar Arsip</a></li>
                    <li><a href="<?php echo site_url('dokuments'); ?>"><i class="fa fa-object-group"></i> Kelompok</a></li>
                    <li><a href="<?php echo site_url('lemari'); ?>"><i class="fa fa-building"></i> Lemari</a></li>
                    <li><a href="<?php echo site_url('kotak'); ?>"><i class="fa fa-cube"></i> Kotak</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>Pengaturan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('parameters'); ?>"><i class="fa fa-wrench"></i> Parameter</a></li>
                    <li><a href="<?php echo site_url('users'); ?>"><i class="fa fa-users"></i> Users</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
