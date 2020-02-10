<?php

	require '../config/connection.php';
	$conn = Connect();
	
	$fh = fopen('button1.txt','r');
	while ($line = fgets($fh)) {
   $button1=$line;
	}
	fclose($fh);

	$fh2 = fopen('button2.txt','r');
	while ($line2 = fgets($fh2)) {
   $button2=$line2;
	}
	fclose($fh2);

	$result_array = array();

	$query= "SELECT * FROM sensordata order by id desc";
	$result = mysqli_query($conn, $query);
					if (mysqli_num_rows($result) > 0)
						{
							$row = mysqli_fetch_assoc($result);
							$result_array['sen_temp'] = $row['temp'];
							$result_array['sen_light'] = $row['light'];
							$result_array['sen_ph'] = $row['ph'];
							$result_array['sen_humidity'] = $row['humidity'];
							$result_array['btn1'] = $button1;
							$result_array['btn2'] = $button2;						}

mysqli_close($conn);

	echo json_encode($result_array);
?>