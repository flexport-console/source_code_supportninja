<?php 
include 'function.php';

if (isset($_POST['btn_submit']) && $_POST['btn_submit']=="btn_submit") {
	$flex_id = mysqli_real_escape_string($conn, preg_replace('/[^0-9]/', '', $_POST['flex_id']));
	$sop = mysqli_real_escape_string($conn, $_POST['sop']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
	$number = mysqli_real_escape_string($conn, $_POST['number']);

	if (tracker_input($conn, $userid, $flex_id, $status, $remarks, $sop, $date, $time, $number)) {
		echo "success";
	}else{
		echo "failed";
	}
}

?>