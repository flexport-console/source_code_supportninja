<?php 
include 'dbconnect.php';
date_default_timezone_set('asia/manila');
$time = date("H:i:s");
$date = date("F d, Y");


// Calculate the Time Diff
function timeDiff($start, $end){
	if (empty($start) || empty($end)) {
		echo "No Time";
	}else{
		// create two DateTime objects representing the times
		$time1 = new DateTime($start);
		$time2 = new DateTime($end);

		// calculate the difference between the times
		$interval = $time1->diff($time2);

		// output the difference in hours, minutes, and seconds
		echo $interval->format('%H:%I:%S');
	}
}



function tracker_input($conn, $employee_id, $flexid, $status, $remarks, $sop, $date, $time, $number){

	$select_last_time = "SELECT * FROM queue WHERE user_employee_id='$employee_id' AND q_end_time!='' AND q_date='$date' ORDER BY q_end_time DESC LIMIT 1";
	$select_last_time_res = mysqli_query($conn, $select_last_time);

	if (mysqli_num_rows($select_last_time_res)>0) {
		$row = mysqli_fetch_assoc($select_last_time_res);
		$end = $row['q_end_time'];


		$sop_sel = mysqli_query($conn, "SELECT * FROM r_sop WHERE s_name='$sop'");
		$sop_f = mysqli_fetch_assoc($sop_sel);

		$workflow = $sop_f['s_workflow'];
		$linebusiness= $sop_f['s_linebusiness'];


		$insert = "INSERT INTO queue VALUES (null, '$employee_id', '$flexid', '$status', '$remarks', '$linebusiness', '$workflow', '$sop', '$date', '$time', 'pending', '$end','$time', '$number', '$employee_id')";
		$insert_res = mysqli_query($conn, $insert);
		if ($insert_res) {
			return true;
		}
	}else{
		return false;
	}
}




function checkBreak($conn, $employee_id, $punch, $name, $date, $time){
	$check = mysqli_query($conn, "SELECT * FROM queue WHERE q_remarks='$name' AND q_date='$date' AND user_employee_id='$employee_id' ORDER BY q_id DESC LIMIT 1");

	if (mysqli_num_rows($check)>0) {
		if ($punch == 0000000) {
			return true;
		}else{
			return false;
		}
	}else{
		return true;
	}
}


function breakSched($conn, $employee_id, $punch, $name, $date, $time){

	if (checkBreak($conn, $employee_id, $punch, $name, $date, $time)) {
		$insert_break = "INSERT INTO queue VALUES (null, '$employee_id', '$punch', 'break', '$name', 'break', 'break', 'break', '$date', '$time', 'break', '$time', '$time',0,'$employee_id')";
		$insert_break_res = mysqli_query($conn, $insert_break);
		if ($insert_break_res) {
			if ($name=="End Shift") {
				$end_shift = "UPDATE queue SET q_status='Untouched', q_remarks='Untouched' WHERE user_employee_id='$employee_id' AND q_date='$date' AND q_status='' AND q_remarks=''";
				$end_shift_res = mysqli_query($conn, $end_shift);
				if ($end_shift_res) {
					$end_shift_2 = "UPDATE queue SET q_submitted='queue' WHERE user_employee_id='$employee_id'";
					$end_shift_res_2 = mysqli_query($conn, $end_shift_2);
				}
			}
			return true;
		}
		
	}else{
		return false;
	}
}




if (isset($_POST['punch_btn'])) {
	$punch = mysqli_real_escape_string($conn, $_POST['punch']);

	if ($punch == 0000000) {
		if (breakSched($conn, $user_id, $punch, 'Ready', $date, $time)) {
			echo "punched";
		}
	}elseif ($punch == 9999991) {
		if (breakSched($conn, $user_id, $punch, 'First Break - Start', $date, $time)) {
			echo "punched";
		}else{
			echo "punched_already";
		}
	}elseif ($punch == 9999993) {
		if (breakSched($conn, $user_id, $punch, 'Lunch Break - Start', $date, $time)) {
			echo "punched";
		}else{
			echo "punched_already";
		}
	}elseif ($punch == 9999995) {
		if (breakSched($conn, $user_id, $punch, 'Last Break - Start', $date, $time)) {
			echo "punched";
		}else{
			echo "punched_already";
		}
	}elseif ($punch == 9999997) {
		if (breakSched($conn, $user_id, $punch, 'End Shift', $date, $time)) {
			echo "reload";
		}else{
			echo "punched_already";
		}
	}
}


?>