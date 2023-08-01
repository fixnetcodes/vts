<?php
include('../layouts/header.php');
require_once __DIR__ .'/../database/DBConfig.php';

$database = new DB();
$data = $database->connect();

$query = "SELECT * FROM vessels ORDER BY id ASC";
$stmt = $data->prepare($query);
$stmt->execute();
$Users = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $Vessels[] = $row;
}
?>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Vessel Details</h1>
          </div><!-- /.col -->
		  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="create-vessel.php" class="btn btn-info gray-dark"><i class="ion ion-plus"></i> Create Vessel </a></li>
                    </ol>
                </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="card card-default">
                    
                    <div class="card-body">
                    <div class="message"></div>
                        <div class="">
                            <table class="table table-bordered table-striped table-hover" id="userTable" width="100%">
                                <thead>
                                    <tr style="background-color: #2a67b2;color: #ffffff">
                                        <th>Sr No</th>
                                        <th>Vessel Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                   <?php 
                                   $i=1;
                                   foreach($Vessels as $key => $values) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $values['vessel_name']; ?></td>
                                        <td><?php echo $values['description']; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="create-vessel.php?id=<?php echo $values['id'] ?>"><i class="ion ion-compose"></i></a>
                                            <button type="button" class="btn btn-danger delete-btn btn-sm" data-id="<?php echo $values['id'] ?>"><i class="ion ion-trash-a"></i></button>
                                        </td>
                                    </tr>
                                   <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deleteUser" method="post">
                    <fieldset>
                        <div class="col-md-4 form-group">
                            <input type="hidden" id="user_id" name="user_id" class="form-control">
                        </div>
                        <div class="col-md-12 form-group user-form-group">
                            <label class="control-label">Are you sure you want to delete this user?</label>
                            <div class="text-right">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">NO</button>
                                <button type="submit" id="cancel_btn" class="btn btn-primary btn-sm">YES</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->

</div>
<?php include ('../layouts/footer.php');?>
<script src="../assets/dist/js/pages/users.js"></script>
<script>
   $(document).ready(function(){ 
      $('#userTable').DataTable({
      "processing": true,
      "fixedHeader": true,
      }); 
    }); 
</script>