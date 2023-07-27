<?php
include('../layouts/header.php');
require_once __DIR__ . '/../database/DBConfig.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = new DB();
$data = $db->connect();
$username = $_SESSION['username'];
// echo $username;

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-2 col-6">
          <a href="users-list.php">
            <div class="small-box" style="background-color:#2a67b2; color:#ffffff">
              <div class="inner">
                <h6 style="text-transform:uppercase">Users</h6>
                <div class="inner-spacer nopadding">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6"><h3><?php echo '5' ?></h3></div>
                  </div>
                </div>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-2 col-6">
          <a href="vessel-list.php">
            <div class="small-box" style="background-color:#2a67b2; color:#ffffff">
              <div class="inner">
                <h6 style="text-transform:uppercase">Vessels</h6>
                <div class="inner-spacer nopadding">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6"><h3><?php echo '4'; ?></h3></div>
                  </div>
                </div>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Reported Vessel Emergencies</h3>
            </div>
            <div class="card-body">
              <div id="map"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include ('../layouts/footer.php'); ?>

