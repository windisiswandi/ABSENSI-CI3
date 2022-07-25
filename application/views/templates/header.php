<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url("assets/images/semka.png") ?>" type="image/x-icon">
    <title><?= $title; ?> </title>

    <!-- Bootstrap -->
    <link  href="<?= base_url(); ?>assets/vendors/bootstrap5/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>assets/vendors/fontawesome5/css/fontawesome.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendors/fontawesome5/css/brands.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendors/fontawesome5/css/solid.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?= base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jquery -->
    <script src="<?= base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- sweetalert2 -->
    <script src="<?= base_url(); ?>assets/vendors/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- Custom Theme Style -->
    <link href="<?= base_url(); ?>assets/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= base_url(); ?>" class="site_title">
                <img src="<?= base_url("assets/images/semka.png"); ?>" width="80">
                <h6 class="mt-2">Administrator</h6>
              </a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li>
                    <a href="<?= base_url("Dashboard"); ?>"><i class="fas fa-tachometer-alt"></i>DASHBOARD</a>
                  </li>
                  <li>
                    <a><i class="fas fa-chart-pie"></i>REKAP ABSENSI<i class="fas fa-chevron-down"></i></a>
                    <ul class="nav child_menu">
                      <li><a  href="<?= base_url("absensi/rekap_absensi_harian") ?>">Per Hari</a></li>
                      <li><a  href="<?= base_url("absensi/rekap_absensi_mingguan") ?>">Per Minggu</a></li>
                    </ul> 
                  </li>
                  <li>
                    <a href="<?= base_url("dashboard/generate_QRcode"); ?>"><i class="fas fa-qrcode"></i>GENERATE QRCODE</a>
                  </li>
                  <li>
                    <a><i class="fas fa-users"></i>PRESENSI<i class="fas fa-chevron-down"></i></a>
                     <ul class="nav child_menu">
                      <li><a  href="<?= base_url("Dashboard/atur_sesi_absen") ?>">Atur Sesi</a></li>
                      <li><a  href="<?= base_url("Absensi/absensi_admin") ?>">Absensi</a></li>
                    </ul> 
                  </li>
                  <li>
                    <a><i class="fas fa-cog"></i>SETTING<i class="fas fa-chevron-down"></i></a>
                     <ul class="nav child_menu">
                        <li><a href="<?= base_url('Dashboard/editData'); ?>">Setting Data</a></li>
                        <li><a href="<?= base_url('Dashboard/setKelas'); ?>">Setting Kelas</a></li>
                    </ul> 
                  </li>

                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

          </div>
        </div>
       <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?= base_url("assets/images/Admin-img.png"); ?>" alt="">Administrator
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="<?= base_url("Dashboard"); ?>?logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    <?php
                      if (isset($_GET["logout"])) {
                        $this->session->unset_userdata('login');
                        redirect('Auth/login');
                      }
                    ?>
                  </div>
                </li>
                <li class="nav-item fw-bold fs-6" id="time" style="padding: 5px 6px 0 0;"></li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
