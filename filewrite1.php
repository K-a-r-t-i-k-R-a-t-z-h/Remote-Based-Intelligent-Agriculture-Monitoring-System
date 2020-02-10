<?php

$cnt=$_POST["data"];

if ($cnt =="ON") {
	$status="OFF";
}
if ($cnt =="OFF") {
	$status="ON";
}

$file = fopen("button1.txt","w");
fwrite($file,$status);
fclose($file);

?>