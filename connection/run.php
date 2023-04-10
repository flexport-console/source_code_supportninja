<?php 
include 'function.php';


if (isset($_POST['run_btn'])) {
	$date = mysqli_real_escape_string($conn, $_POST['qdate']);

	$source_format = 'Y-m-d';

	// Convert the source date to the target format
	$target_format = 'F d, Y';
	$target_date = date($target_format, strtotime($date));
	echo $_SESSION['searchDate'] = $target_date;
}



?>