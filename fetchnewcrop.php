<?php
/*
	require 'connection.php';
	$conn = Connect();
	*/
	$date=date('Y-m-d');

	$new_crop = $_POST['data'];

	if($new_crop == 'Rice'){
		$days=120;
	}
	if($new_crop == 'Wheat'){
		$days=150;
	}
	if($new_crop == 'Cotton'){
		$days=180;
	}
	if($new_crop == 'Groundnut'){
		$days=120;
	}
	if($new_crop == 'Tomato'){
		$days=80;
	}
	if($new_crop == 'Brinjal'){
		$days=80;
	}
	
	$edate = strtotime(date("Y-m-d", strtotime($date)) . " +$days day");
  	$end_date=date("Y-m-d",$edate);
	$result_array = array();
	$result_array['total_duration'] = $days;
	$result_array['from_date'] = $date;
	$result_array['to_date'] = $end_date;


	echo json_encode($result_array);
?>