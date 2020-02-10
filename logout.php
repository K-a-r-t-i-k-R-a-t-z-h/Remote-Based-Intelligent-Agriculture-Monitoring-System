<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['caty']);
unset( $_SESSION['field_id']);
unset($_SESSION['t_id']);
unset($_SESSION['c_crop']);
unset( $_SESSION['f_email']);
unset( $_SESSION['c_days']);
unset( $_SESSION['c_end']);
session_destroy();
header('Location:../index.php');
?>
