<?php

$cnt=$_POST["data"];

if ($cnt =="ON") {
	$status="OFF";
}
if ($cnt =="OFF") {
	$status="ON";
}

$file = fopen("button2.txt","w");
fwrite($file,$status);
fclose($file);

?>