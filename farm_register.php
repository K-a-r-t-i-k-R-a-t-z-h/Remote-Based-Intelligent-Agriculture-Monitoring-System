<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Farmer Registration </title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../dist/css/jquery.validate.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
 <h2 align="center">IoT Farming</h2>
    <div class="container">
        <br><br><br><br>

            <div class="col-md-4 col-md-offset-4">

                <div class="panel panel-primary">

                    <div class="panel-heading">
                     <h3 class="panel-title">Sign Up</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" autocomplete="off">
                            <fieldset>
                                <div class="form-group">
             <input class="form-control" placeholder="Field ID"  id="fid" name="fid" type="text" autofocus  required>
                                </div>
                                 <div class="form-group">
             <input class="form-control" placeholder="Username"  id="fid" name="username" type="text" autofocus  required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="password" name="password" type="password" value="" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email"  name="email" type="email" value="" required>
                                </div>

                                 <div class="form-group">
                                    <select class="form-control" name="cur_crop" required>
                                        <option value="">-- Select Current Crop --</option>
                                        <option value="Rice">Rice</option>
                                        <option value="Wheat">Wheat</option>
                                        <option value="Cotton">Cotton</option>
                                        <option value="Groundnut">Groundnut</option><option value="Tomato">Tomato</option>
                                        <option value="Brinjal">Brinjal</option>

                                    </select>
                                </div> 
                              
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="col-md-6">
                                <input type="submit" value="Register" name="submit" class="btn btn-lg btn-success btn-block">
                            </div>
                                <div class="col-md-6">
                                <a href="login.php"><input  value="Login" name="submit" class="btn btn-lg btn-success btn-block"></a>
                            </div>
                            
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
 <script src="../dist/jquery-1.3.2.js" type="text/javascript"></script>
 <script src="../dist/jquery.validate.js" type="text/javascript"></script>
 <!-- <script type="text/javascript">
            
            jQuery(function(){
                jQuery("#id").validate({
                    expression: "if (VAL.match(/^[a-z]$/)) return true; else return false;",
                    message: "Should be a valid id"
                });
                jQuery("#password").validate({
                    expression: "if (VAL.match(/^[a-z]$/)) return true; else return false;",
                    message: "Should be a valid password"
                });
                
            });
            
        </script> -->
</body>

</html>
<?php
if(isset($_POST['submit'])){

require '../config/connection.php';
$conn= Connect();

//for inactive Account
$field_id = $conn->real_escape_string($_POST['fid']);
$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);
$email = $conn->real_escape_string($_POST['email']);
$cur_crop = $conn->real_escape_string($_POST['cur_crop']);

if($cur_crop == "Rice"){
    $category = "A";
    $days = 120;
    }

if($cur_crop == "Wheat"  ){
    $category = "A";
    $days = 150;
    }

if($cur_crop == "Cotton" ){
    $category = "B";
    $days = 180;
    }

if($cur_crop == "Groundnut"){
    $category = "B";
    $days = 120;
    }

if($cur_crop == "Tomato" || $cur_crop == "Brinjal"){
    $category = "C";
    $days = 80;
    }
    #to find end date
$date = date("Y-m-d");
$end_date = strtotime(date("Y-m-d", strtotime($date)) . " +$days day");
$cultivation_end = date("Y-m-d",$end_date);
$cultivation_from = $date;
#echo $cultivation_end;



#echo $category;

$query= "INSERT INTO farmer_reg(id, field_id, username, password, email, cur_crop, cultivation_from, cultivation_end, crop_days, crop_category) " 
            . "VALUES (default, '$field_id','$username','$password','$email','$cur_crop','$cultivation_from','$cultivation_end','$days','$category')";
$success = $conn->query($query);

if($success){
//echo '<script language="javascript"> alert("Registration Successfull")
    //window.location.href = "index.php" </script>';
    //
    $_SESSION['message1']="Registered Successfully.Login to Continue...";
    //Header('Location: index.php');
    echo '<script language="javascript"> 
    window.location.href = "login.php" </script>';
    
}
//For invalid Password
else{
    $_SESSION['message2']="Registration Failed!... ";
    echo '<script language="javascript">
            window.location.href = "login.php" </script>';
}
mysqli_close($conn);
    }
?>