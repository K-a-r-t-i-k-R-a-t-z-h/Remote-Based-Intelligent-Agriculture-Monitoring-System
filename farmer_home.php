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
		<input class="form-control" id="temp" name="sub1" readonly>
	</div>
	 </div>	
	<br><br>	

     <div class="form-group">
		<div class="col-lg-4">
		<label>Light</label>
		</div>
		<div class="col-lg-6">
		<input class="form-control" id="light" name="sub2" readonly>
	 </div>
	 </div>	
	<br><br>	

	<div class="form-group">
	<div class="col-lg-4">
	 <label>PH</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control" id="ph"  name="sub3" readonly>
	</div>
	</div>
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Humidity</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control" id="humidity"  name="sub3" readonly>
	</div>
	</div>	
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Switch1(status)</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control" id="sw1"  name="s1" readonly>
	</div>
	</div>	
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label>Switch2(status)</label>
	</div>
	<div class="col-lg-6">
	<input class="form-control" id="sw2"  name="s2" readonly>
	</div>
	</div>	
	<br><br>

	<div class="form-group">
	<div class="col-lg-4">
	 <label></label>
	</div>
	<div class="col-lg-3">
	<input type="submit" class="btn btn-primary s1on" name="submit" value="Switch1 (ON/OFF)">
	</div>
	<!--<div class="col-lg-3">
	<input type="submit" class="btn btn-primary s1off" name="submit" value="Switch1 (OFF)">
	</div>-->
	</div>
	<br><br>
	<div class="form-group">
	<div class="col-lg-4">
	 <label></label>
	</div>
	<div class="col-lg-3">
	<input type="submit" class="btn btn-primary s2on" name="submit" value="Switch2 (ON/OFF)">
	</div>
	<!--
	<div class="col-lg-3">
	<input type="submit" class="btn btn-primary s2off" name="submit" value="Switch2 (OFF)">
	</div>-->
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
    
       setInterval(function()
        {
        	$.ajax({
					type : "POST",
					/*data : {data:new_crop},*/
					url : "fetchsensor.php",
					success : function(res){
						var result = $.parseJSON(res);
						$("#temp").val(result.sen_temp);
						$("#light").val(result.sen_light);
						$("#ph").val(result.sen_ph);
						$("#humidity").val(result.sen_humidity);
						$("#sw1").val(result.btn1);
						$("#sw2").val(result.btn2);
					}
				});

        }, 1000);
   </script>

   <script>  
 $(document).ready(function(){  
      $('.s1on').click(function(){  
           var s1_id = $("#sw1").val();
           $.ajax({
					type : "POST",
					data : {data:s1_id},
					url : "filewrite1.php",
					
				});
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.s1off').click(function(){  
           var s1_id = $("#sw1").val();
         $.ajax({
					type : "POST",
					data : {data:s1_id},
					url : "filewrite1.php",
				});
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.s2on').click(function(){  
           var s1_id = $("#sw2").val();
          $.ajax({
					type : "POST",
					data : {data:s1_id},
					url : "filewrite2.php",
				});
           
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.s2off').click(function(){  
           var s1_id = $("#sw2").val();
          $.ajax({
					type : "POST",
					data : {data:s1_id},
					url : "filewrite2.php",
				});
      });  
 });  
 </script>
 
       <script>
        setTimeout(function(){
            let alert = document.querySelector(".alert");
            alert.remove();
        },4000);
    </script>
</body>

</html>
