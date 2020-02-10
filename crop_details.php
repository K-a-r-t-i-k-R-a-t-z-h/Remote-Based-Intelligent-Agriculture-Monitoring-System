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
<title>Dashboard</title>
<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<form method="post" >
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
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading"><b> Current Crop Details</b></div>
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
		<label>Field ID :</label>
		</div>
		<div class="col-lg-6">
		
		<input class="form-control" readonly name="sub1" value="<?php echo $row['field_id'];?>">
	</div>
	 </div>	
	<br><br>																					
		<div class="form-group">
		<div class="col-lg-4">
		<label>Current Crop :</label>
		</div>
		<div class="col-lg-6">
		<input class="form-control" readonly name="sub1" value="<?php echo $row['cur_crop'];?>">
	</div>
	 </div>	
	<br><br>	

     <div class="form-group">
		<div class="col-lg-4">
		<label>Total Duration(in Days) :</label>
		</div>
		<div class="col-lg-6">
		<input class="form-control" readonly name="sub2" value="<?php echo $row['crop_days'];?>">
	 </div>
	 </div>	
	<br><br>	

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Cultivation Period(FROM) :</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control" readonly name="sub3" value="<?php echo $row['cultivation_from'];?>">
	</div>
	</div>
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Cultivation Period(END): </label>
	</div>
	<div class="col-lg-6">
	<input class="form-control" readonly  name="sub3" value="<?php echo $row['cultivation_end'];?>">
	</div>
	</div>	
	<br><br>

<?php

function dateDiffInDays($date1, $date2)  
{ 
    $diff = strtotime($date2) - strtotime($date1); 
    return abs(round($diff / 86400)); 
} 
$date = date("Y-m-d");
$date1 = $date; 
$date2 = $row['cultivation_end']; 
$dateDiff = dateDiffInDays($date1, $date2); 
?>


	<div class="form-group">
	<div class="col-lg-4">
	 <label>Days Left(Cultivation):</label>
	</div>
	<div class="col-lg-6">
	<input readonly class="form-control"  name="sub3" value="<?php echo $dateDiff;?>"  >
	</div>
	</div>	
	<br><br>
 
<!-- 	<div class="form-group">
	<div class="col-lg-6">
	 <label></label>
	</div>
	<div class="col-lg-6">
	<input type="submit" class="btn btn-primary" name="submit" value="Get Crop Sugesstions">
	</div>
	 <div class="col-lg-3">
	<input type="submit" class="btn btn-primary" name="submit" value="Switch2">
	</div>
	</div> 
	<br><br> -->

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

</body>

</html>
