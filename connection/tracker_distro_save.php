<?php 
include 'function.php';

if (isset($_POST['tracker_default']) && !empty($_POST['tracker_default'])) {

	$q_id = mysqli_real_escape_string($conn, $_POST['tracker_default']);
	$q_status = mysqli_real_escape_string($conn, (!empty($_POST['status'])) ? $_POST['status'] : '');
	$q_remarks = mysqli_real_escape_string($conn, (!empty($_POST['remarks'])) ? $_POST['remarks'] : '');
	$q_shipment = mysqli_real_escape_string($conn, (!empty($_POST['shipment'])) ? $_POST['shipment'] : 1);



	$view_end_time = "SELECT q_end_time FROM queue WHERE q_id='$q_id'";
	$view_end_time_res = mysqli_query($conn, $view_end_time);
	$row = mysqli_fetch_assoc($view_end_time_res);

	if (!empty($row['q_end_time'])) {
		$update_queue = "UPDATE queue SET q_status='$q_status', q_shipment='$q_shipment', q_remarks='$q_remarks' WHERE q_id='$q_id' AND user_employee_id='$user_id'";
		$update_queue_res = mysqli_query($conn, $update_queue);

		if ($update_queue_res) {
			echo $q_id;//asd
		}
	}else{
		// This will get the time end of last updated flex-ID
		$find_last = mysqli_query($conn, "SELECT * FROM queue WHERE user_employee_id='$user_id' AND q_date='$date' ORDER BY q_end_time DESC LIMIT 1");
		$find_last_res = mysqli_fetch_assoc($find_last);
		$start_ = $find_last_res['q_end_time'];

		$update_queue = "UPDATE queue SET q_status='$q_status', q_shipment='$q_shipment', q_remarks='$q_remarks', q_end_time='$time' WHERE q_id='$q_id' AND user_employee_id='$user_id'";
		$update_queue_res = mysqli_query($conn, $update_queue);

		if ($update_queue_res) {
			$update_queue_1 = "UPDATE queue SET q_start_time='$start_' WHERE q_id='$q_id' AND user_employee_id='$user_id'";
			$update_queue_res_1 = mysqli_query($conn, $update_queue_1);
			echo $q_id;
		}
		
	}
}





?>