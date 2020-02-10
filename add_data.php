<?php
    // Connect to MySQL
	require '../config/connection.php';
     $conn = Connect();
    // Prepare the SQL statement
    
    //cetinkay_webtek.webtek
    $SQL = "INSERT INTO sensordata (id,temp,light,ph,humidity) VALUES (default,'".$_GET["temp"]."','".$_GET["light"]."','".$_GET["ph"]."','".$_GET["humidity"]."')";     
       
    // Execute SQL statement
 $success = $conn->query($SQL);

 /*   if($success){
	    header("Location: farmer_home.php");
   }
    */
?>