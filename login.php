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

    <title>Farmer Login </title>

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

                <div class="panel panel-primary">

                    <div class="panel-heading">
                     <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" autocomplete="off">
                            <fieldset>
                                <div class="form-group">
                                    <label>Username</label>
             <input class="form-control" placeholder="Enter Username" name="username" type="text" autofocus  required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" placeholder="Enter Password"  name="password" type="password" value="" required>
                                </div>

                                <!-- <div class="form-group">
                                    <select class="form-control" required>
                                        <option value="">--Select User Type--</option>
                                        <option value="Farmer">Farmer</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div> -->
                              
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="col-md-6">
                                <input type="submit" value="Login" name="submit" class="btn btn-lg btn-success btn-block">
                            </div>
                            <div class="col-md-6">
                               <a href="farm_register.php"> <input value="Register" name="submit" class="btn btn-lg btn-success btn-block"></a>
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

<!--  <script type="text/javascript">
            
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

        require '../config/connection.php';
            $conn= Connect();
     
        $username_form = $conn->real_escape_string($_POST['username']);
        $password_form = $conn->real_escape_string($_POST['password']);

$query="SELECT  username, password,crop_category,field_id,id,cur_crop,email,crop_days,cultivation_end FROM farmer_reg WHERE username=? and password=?";

//protect SQL INJECTION
$stmt = $conn->prepare($query);
$stmt -> bind_param("ss", $username_form, $password_form) ;
$stmt -> execute();
$stmt -> bind_result($username, $password,$category,$f_id,$tid,$ccrop,$f_email,$cdays,$c_end);
$stmt -> store_result();
$stmt-> fetch();

//for inactive Account
if($username == $username_form && $password == $password_form ){
    $_SESSION['login']=$username;
    $_SESSION['caty']=$category;
    $_SESSION['field_id']=$f_id;
    $_SESSION['t_id']=$tid;
    $_SESSION['c_crop']=$ccrop;
    $_SESSION['f_email']=$f_email;
    $_SESSION['c_days']=$cdays;
    $_SESSION['c_end']=$c_end;

    echo '<script language="javascript"> 
        window.location.href = "farmer_home.php" </script>';
}

//For invalid Password
else{
    $_SESSION['message2']="Username Or Password is Incorrect!... ";
    echo '<script language="javascript">
            window.location.href = "login.php" </script>';
}
mysqli_close($conn);
    }



?>