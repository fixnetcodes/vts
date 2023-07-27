<?php
session_start();
// include('../database/connection.php');
// /////// session define in header /////////
if (empty($_SESSION['user'])) {
?>
  <script>
    window.location.href = 'http://localhost/vts/index.php'
  </script>
<?php
}
$name = $_SESSION['username'];
$type = $_SESSION['usertype'];
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VTS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <!--<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">-->

  <!--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">-->
</head>
<!--<body class="hold-transition sidebar-mini layout-fixed">-->

<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="background-color: #2a67b2;">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: #ffffff"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../views/dashboard.php" class="nav-link" style="color: #ffffff">Home</a>
        </li>
      </ul>
       <!-- Right navbar links -->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4 mt-5">
      <!-- Brand Logo -->
      <a href="../views/dashboard.php" class="brand-link">
        <span class="brand-text font-weight-bolder" style="color: #002876">VTS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo "<b>", $name, "</b><br>", $type; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
              <a href="../views/dashboard.php" class="nav-link active" style="background-color: #2a67b2">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <?php if ($_SESSION['usertype'] == "Admin") { ?>
              <li class="nav-item has-treeview">
                <a href="../views/create-user.php" class="nav-link">
                  <i class="nav-icon fas fa-user" style="color: #2a67b2"></i>
                  <p style="font-size: 15px">
                    CREATE USER
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="../views/create-vessel.php" class="nav-link">
                  <i class="nav-icon fas fa-user" style="color: #2a67b2"></i>
                  <p style="font-size: 15px">
                    CREATE VESSEL
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="../views/view-emergencies.php" class="nav-link">
                  <i class="nav-icon fas fa-bars" style="color: #2a67b2"></i>
                  <p style="font-size: 15px">
                    VIEW EMERGENCIES
                  </p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="../index.php" class="nav-link">
                <i class="fas fa-power-off nav-icon" style="color: #2a67b2"></i>
                <p style="font-size: 15px">LOGOUT</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>