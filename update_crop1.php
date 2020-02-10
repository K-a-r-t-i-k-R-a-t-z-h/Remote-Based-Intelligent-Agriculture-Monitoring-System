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
						<div class="panel-heading">Sensor Data</div>
						<div class="panel-body">
							<div class="row">
						 	<div class="col-lg-10">																					
		<div class="form-group">
		<div class="col-lg-4">
		<label>Temperature</label>
		</div>
		<div class="col-lg-6">
		<input class="form-control"  name="sub1">
	</div>
	 </div>	
	<br><br>	

     <div class="form-group">
		<div class="col-lg-4">
		<label>Light</label>
		</div>
		<div class="col-lg-6">
		<input class="form-control"  name="sub2">
	 </div>
	 </div>	
	<br><br>	

	<div class="form-group">
	<div class="col-lg-4">
	 <label>PH</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control"  name="sub3">
	</div>
	</div>
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Humidity</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control"  name="sub3">
	</div>
	</div>	
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label></label>
	</div>
	<div class="col-lg-3">
	<input type="submit" class="btn btn-primary" name="submit" value="Switch1">
	</div>
	<div class="col-lg-3">
	<input type="submit" class="btn btn-primary" name="submit" value="Switch2">
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
