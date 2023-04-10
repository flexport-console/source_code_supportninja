<?php 
date_default_timezone_set('asia/manila');
$date = date("F d, Y"); // Date Today
$month = date("F"); // Current Month

$user_employee_id = $_SESSION['user_id'];


$select_distro = "SELECT * FROM queue WHERE user_employee_id='$user_employee_id' AND q_submitted='pending'";
$select_distro_res = mysqli_query($conn, $select_distro);

// Calculate the Time Diff
function timeDiff($start, $end){
	// create two DateTime objects representing the times
	$time1 = new DateTime($start);
	$time2 = new DateTime($end);

	// calculate the difference between the times
	$interval = $time1->diff($time2);

	// output the difference in hours, minutes, and seconds
	echo $interval->format('%H:%I:%S');
}
$select_status = "SELECT * FROM r_status";




$user_sop_modal = mysqli_query($conn, "SELECT * FROM users_sop WHERE user_employee_id='$user_employee_id'");


?>
