<?php
session_start ();
include_once('../config/connection.php');
$conn=Connect();
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
					<h4 class="page-header"> <?php echo strtoupper("welcome"." ".htmlentities($_SESSION['login']));?></h4>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading"><b> Update Crop Details</b></div>
						<div class="panel-body">
							<div class="row">
						 	<div class="col-lg-10">

	<div class="form-group">
		<div class="col-lg-4">
		<label>Field ID :</label>
		</div>
		<div class="col-lg-6">
			<input class="form-control" type="hidden" name="id" value="<?php  echo $_SESSION['t_id']?>">
		<input class="form-control"  name="fid" value="<?php  echo $_SESSION['field_id']?>">
	</div>
	 </div>	
	<br><br>																					
		<div class="form-group">
		<div class="col-lg-4">
		<label>Current Crop :</label>
		</div>
		<div class="col-lg-6">
		<select class="form-control" name="crop" id="new_crop"  required >
			<?php
			$caty = $_SESSION['caty'];
        $res=mysqli_query($conn, "SELECT * FROM crops WHERE category != '$caty'");
					echo "<option value=''>--SELECT--</option>";
					while($row=mysqli_fetch_array($res))
					{
					echo "<option value='$row[1]'>".$row[1]."</option>";
					}?></select>
	</div>
	 </div>	
	<br><br>	

     <div class="form-group">
		<div class="col-lg-4">
		<label>Total Duration(in Days) :</label>
		</div>
		<div class="col-lg-6">
		<input class="form-control" id="cdays"  name="days" readonly>
	 </div>
	 </div>	
	<br><br>	

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Cultivation Period(FROM) :</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control" id="cfrom" name="from" readonly>
	</div>
	</div>
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Cultivation Period(END): </label>
	</div>
	<div class="col-lg-6">
	<input class="form-control" id="cto"  name="to" readonly>
	</div>
	</div>	
	<br><br>

	<!-- <div class="form-group">
	<div class="col-lg-4">
	 <label>Days Left(Cultivation):</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control"  name="sub3">
	</div>
	</div>	
	<br><br> -->
 
	<div class="form-group">
	<div class="col-lg-4">
	 <label></label>
	</div>
	<div class="col-lg-3">
	<input type="submit" class="btn btn-primary" name="submit" value="Update">
	</div>
	<div class="col-lg-3">
	<input type="reset" class="btn btn-primary" name="reset" value="Reset">
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
<script>
		$(document).ready(function() {
			$("#new_crop").change(function() {
				var new_crop = $("#new_crop").val();
				/*alert(new_crop);*/

				$.ajax({
					type : "POST",
					data : {data:new_crop},
					url : "fetchnewcrop.php",
					success : function(res){
						var result = $.parseJSON(res);
						$("#cdays").val(result.total_duration);
						$("#cfrom").val(result.from_date);
						$("#cto").val(result.to_date);
						
					}
				});
			});
		});
	</script>
</body>

</html>
<?php 
if(isset($_POST['submit'])){
    $id = $conn->real_escape_string($_POST['id']);
    
    $fid = $conn->real_escape_string($_POST['fid']);
    $crop = $conn->real_escape_string($_POST['crop']);
    $days = $conn->real_escape_string($_POST['days']);
    $from = $conn->real_escape_string($_POST['from']);
    $to = $conn->real_escape_string($_POST['to']);
    if($crop == "Rice"){
    $category = "A";
    $days = 120;
    }

if($crop == "Wheat"  ){
    $category = "A";
    $days = 150;
    }

if($crop == "Cotton" ){
    $category = "B";
    $days = 180;
    }

if($crop == "Groundnut"){
    $category = "B";
    $days = 120;
    }

if($crop == "Tomato" || $cur_crop == "Brinjal"){
    $category = "C";
    $days = 80;
    }  

    $query= "UPDATE `farmer_reg` SET `field_id`='$fid', `cur_crop`='$crop', `crop_days`='$days', `cultivation_from`='$from', `cultivation_end`='$to', `crop_category`='$category' WHERE id='$id'";
    $success = $conn->query($query);

    if($success){
        $_SESSION['message1']=" Updated Successfully";
        echo '<script language="javascript">
            window.location.href = "update_crop.php" </script>';                                        
    }
    mysqli_close($conn);
}
?>