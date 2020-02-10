<?php
session_start ();
if(!isset($_SESSION['login']))
{
$_SESSION['message2']="Please Login To Continue!... ";
echo '<script language="javascript"> 
        window.location.href = "login.php" </script>';
}

	?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title></title>
<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<form method="post" action="" >
	<div id="wrapper">

		<!-- Navigation -->
		<?php include('leftbar.php')?>;


		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="page-header"> <?php echo strtoupper("welcome"." ".htmlentities($_SESSION['login']));?></h4>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<!-- Alert  3-->
                            <?php
                            if(isset($_SESSION['message1'])){
                            ?>

                            <div class="alert alert-success">
                                <?php echo $_SESSION['message1']; 
                                unset($_SESSION['message1']);
                                ?>
                            </div>


                        <?php } ?>
                             <!-- Alert-End-->
                             <!-- Alert  3-->
                            <?php
                            if(isset($_SESSION['message2'])){
                            ?>

                            <div class="alert alert-danger">
                                <?php echo $_SESSION['message2']; 
                                unset($_SESSION['message2']);
                                ?>
                            </div>

                            
                        <?php } ?>
                             <!-- Alert-End-->
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">User Details</div>
						<div class="panel-body">
							<div class="row">
						 	<div class="col-lg-10">	
						 	<?php 
                     require '../config/connection.php';
                     $conn = Connect();
                     $user_name = $_SESSION['login'];
                     $query ="SELECT * FROM farmer_reg WHERE username='$user_name'";
                     $result = mysqli_query($conn, $query); 
                     if (mysqli_num_rows($result) > 0){  
                     $row = mysqli_fetch_assoc($result);?>																				
		<div class="form-group">
		<div class="col-lg-4">
		<label>Field Id:</label>
		</div>
		<div class="col-lg-6">
			<input class="form-control" type="hidden"  name="id" value="<?php echo $row['id'];?>">
		<input class="form-control"  name="fid" value="<?php  echo $row['field_id'];?>">
	</div>
	 </div>	
	<br><br>	

     <div class="form-group">
		<div class="col-lg-4">
		<label>Username:</label>
		</div>
		<div class="col-lg-6">
		<input class="form-control" readonly name="username" value="<?php echo $row['username'];?>">
	 </div>
	 </div>	
	<br><br>	

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Password:</label>
	</div>
	<div class="col-lg-6">

	<input class="form-control"  name="password" value="<?php echo $row['password'];?>">
	</div>
	</div>
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Email:</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control"  name="email" value="<?php echo $row['email'];?>">
	</div>
	</div>	
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label></label>
	</div>
	<div class="col-lg-3">
	<input type="submit" class="btn btn-primary" name="submit" value="Update">
	</div>
	<div class="col-lg-3">
	<input type="reset" class="btn btn-primary" name="submit" value="Reset">
	</div>
	</div>
	<br><br>

		</div>	<!-- col 10 -->
			</div><!-- row-->
				</div><!-- Panel body-->	
					</div><!-- Panel default-->		
						</div><!-- col 12 -->
							</div><!-- row-->
								</div><!-- Page Wrapper-->
									</div><!-- Wrapper-->
									<?php } ?>    
		</form>	
	<!-- jQuery -->
	<script src="../bower_components/jquery/dist/jquery.min.js"
		type="text/javascript"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"
		type="text/javascript"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../bower_components/metisMenu/dist/metisMenu.min.js"
		type="text/javascript"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../dist/js/sb-admin-2.js" type="text/javascript"></script>
<script>
        setTimeout(function(){
            let alert = document.querySelector(".alert");
            alert.remove();
        },4000);
    </script>
</body>

</html>
<?php 
if(isset($_POST['submit'])){
    $id = $conn->real_escape_string($_POST['id']);
    
    $fid = $conn->real_escape_string($_POST['fid']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $email = $conn->real_escape_string($_POST['email']);
                           
    $query= "UPDATE `farmer_reg` SET `field_id`='$fid', `username`='$username', `password`='$password', `email`='$email' WHERE id='$id'";
    $success = $conn->query($query);

    if($success){
        $_SESSION['message1']=" Updated Successfully";
        echo '<script language="javascript">
            window.location.href = "settings.php" </script>';                                        
    }

    mysqli_close($conn);
}
?>