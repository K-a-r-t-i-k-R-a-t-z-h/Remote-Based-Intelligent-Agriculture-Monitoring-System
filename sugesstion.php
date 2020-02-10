<?php
//index.php
session_start();
$error = '';
$current_crop = $_SESSION['c_crop'];
$cultivation_end =$_SESSION['c_end'];
function dateDiffInDays($date1, $date2)  
{ 
    $diff = strtotime($date2) - strtotime($date1); 
    return abs(round($diff / 86400)); 
} 
$date = date("Y-m-d");
$date1 = $date; 
$date2 = $cultivation_end; 
$daysleft = dateDiffInDays($date1, $date2); 
$email = $_SESSION['f_email'];	#from db	
if($current_crop == 'Rice' || $current_crop=='Wheat'){
$suggested_crop = "Cotton ,Groundnut ,Tomato ,Brinjal ";
}
if($current_crop == 'Cotton' || $current_crop=='Groundnut'){
$suggested_crop = "Rice ,Wheat ,Tomato ,Brinjal ";
}
if($current_crop == 'Tomato' || $current_crop=='Brinjal'){
$suggested_crop = "Rice ,Wheat ,Cotton ,Groundnut ";
}
$name = "IoT";		
$subject = "Crop Suggestion";	
$message = "Current crop : ".$current_crop."<br> Days left for cultivation: ".$daysleft."<br> Suggested Crops are: ".$suggested_crop;

try {
		#require 'class/class.phpmailer.php';
		#require 'class/class.smtp.php';
		require_once "PHPMailer/PHPMailer.php";
		require_once "PHPMailer/SMTP.php";
		require_once "PHPMailer/Exception.php";

		$mail =  new PHPMailer\PHPMailer\PHPMailer(true);
		$mail->IsSMTP();								//Sets Mailer to send message using SMTP
		$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = 465;								//Sets the default SMTP server port
		$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = 'adsmartagriculture@gmail.com';					//Sets SMTP username
		$mail->Password = 'Adsmartagriculture2020';					//Sets SMTP password
		$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From = $email;					//Sets the From email address for the message
		$mail->FromName = $name;				//Sets the From name of the message
		$mail->AddAddress($email , 'IoT');		//Adds a "To" address
		/* $mail->AddCC($_POST["email"], $_POST["name"]); */	//Adds a "Cc" address
		$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
		$mail->IsHTML(true);							//Sets message type to HTML				
		$mail->Subject = $subject;				//Sets the Subject of the message
		$mail->Body = $message;	
		$mail->Send();	
				//An HTML or plain text message body
		if($mail->Send())								//Send an Email. Return true on success or false on error
		{
			$_SESSION['message1']="  Successfully Sent";
        echo '<script language="javascript">
            window.location.href = "farmer_home.php" </script>';
		}
		else
		{
			$_SESSION['message2']=" Failed";
        echo '<script language="javascript">
            window.location.href = "farmer_home.php" </script>';
		}
		}

		catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} 
catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
?>






