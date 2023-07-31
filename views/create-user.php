<?php
include('../layouts/header.php');
// include('../database/connection.php'); //include database connection file
require __DIR__ . '/../database/DBConfig.php';
require_once __DIR__.'/../model/User.php';
$db = new DB();
$data = $db->connect();


if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "SELECT * FROM usermaster WHERE Id = :id ";
	
	$results = $data->prepare($query);
	$results->bindParam(':id', $id);
	$results->execute();
	while($row =$results->fetch(PDO::FETCH_ASSOC)) {
		$User[] = $row;
	}
}

if(isset($_POST['submit'])){
	$post_user = new User();
	$post_user->register();
}
?>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php if(isset($_GET['id'])) { echo 'Edit User'; } else { echo 'Create User'; } ?></h1>
          </div><!-- /.col -->
		  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="users-list.php" class="btn btn-info gray-dark"><i class="fa fa-list"></i> Users List</a></li>
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
                        <h4 class="text-center">
                            <?php
                            if(isset($_SESSION['message']))
                            {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }?>
                        </h4>
                        <form id="adduser" action="" method="post" enctype="multipart/form-data">
							<div class="row">
								
								<div class="col-lg-4">
									<div class="form-group">
										<label>Name <span class="red">*</span></label>
										<input type="text" class="form-control" autocomplete="off" name="fullname" id="name" value="<?php if(isset($_GET['id'])){ echo $User[0]['Name']; }?>" placeholder="NAME" required style="text-transform:uppercase;">
									</div>
								</div>
                                <div class="col-lg-4">
									<div class="form-group">
                                        <label>E-mail <span class="red">*</span></label>
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($_GET['id'])) { echo $User[0]['EmailId']; }?>" placeholder="E-MAIL" required>
										<input type="hidden" class="form-control" name="id" value="<?php if(isset($_GET['id'])) { echo $User[0]['Id']; }?>">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Password <span class="red">*</span></label>
										<input type="password" class="form-control" name="password" placeholder="PASSWORD" value="<?php if(isset($_GET['id'])) { echo $User[0]['Password']; }?>" required>
									</div>
								</div>
								
								<div class="col-lg-4">
									<div class="form-group">
										<label>User Type <span class="red">*</span></label>
										<select class="form-control" name="user_type" id="user_type" required>
											<option value="<?php if(isset($_GET['id'])) { echo strtoupper($User[0]['UserType']); } else { echo ""; } ?>" disabled><?php if(isset($_GET['id'])) { echo strtoupper($User[0]['UserType']); } else { echo "Please select"; } ?></option>
											<option value="Admin">Admin</option>
											<option value="Support">Support</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Mobile Number</label>
										<input type="text" class="form-control" name="mobile" placeholder="MOBILE NUMBER" value="<?php if(isset($_GET['id'])) { echo $User[0]['MobileNo']; } ?>">
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-lg-12">
									<div class="reset-button justify-content">
										<button type="reset" class="btn btn-warning">Reset</button>
										<button type="submit" id="submit" name="submit" class="btn btn-success">Save</button>
									</div>
								</div>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php include ('../layouts/footer.php');?>