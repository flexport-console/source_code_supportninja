<?php 
include 'dbconnect.php';

$userid = $_SESSION['user_id'];

function filterQueue($queue){
	$numbers = preg_replace("/[^0-9]/", "", $queue);
	return $numbers;
}

function addQueue($conn, $userid, $queue, $linebusiness, $workflow, $sop, $time, $date, $addedby){

	if (!empty($userid) || !empty($queue) || !empty($linebusiness) || !empty($workflow)  || !empty($sop)  || !empty($time)  || !empty($date)  || !empty($addedby)) {
		$filtered_queue = filterQueue($queue);
		$filtered_employee_id = filterQueue($userid);
		$insert_queue = "INSERT INTO queue VALUES (null, '$filtered_employee_id','$filtered_queue','','','$linebusiness','$workflow','$sop','$date','$time','pending','','',1,'$addedby')";
		$insert_queue_res = mysqli_query($conn, $insert_queue);
	}
}


if (isset($_POST['btn_queue']) && $_POST['btn_queue'] =="btn_queue") {
	$employee_id = mysqli_real_escape_string($conn, $_POST['d_employee_id']);
	$d_linebusiness = mysqli_real_escape_string($conn, $_POST['d_linebusiness']);
	$d_workflow = mysqli_real_escape_string($conn, $_POST['d_workflow']);
	$d_sop = mysqli_real_escape_string($conn, $_POST['d_sop']);

	if ($d_workflow!="Catch All Validate") {
		
		$d_queue = explode("\n", $_POST['d_queue']);
		$num_elements = count($d_queue);
		$current_iteration = 0;

		foreach ($d_queue as $queue) {
			$current_iteration++;

			$filter_queue = mysqli_real_escape_string($conn, $queue);

			if ($current_iteration == $num_elements) {
				addQueue($conn, $employee_id, $queue, $d_linebusiness, $d_workflow, $d_sop,$time,$date,$userid);
		        echo 'success';

		    } else {
		       	addQueue($conn, $employee_id, $queue, $d_linebusiness, $d_workflow, $d_sop,$time,$date,$userid);
		    }
		}

	}else{
		
		$d_queue = explode("\n", $_POST['d_queue']);


		foreach ($d_queue as $queue) {
			$ticket = explode("\t",$queue);
			if (empty($ticket[0]) || empty($ticket[1])) {
				// header("location: ../queue.php?invalid=distro");
			}else{
				$insert_cav = "INSERT INTO queue_cav VALUES (null,'$employee_id','$ticket[0]','','$d_sop','$ticket[1]','$date','$time','','','pending','$userid','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE','FALSE')";
				$insert_res = mysqli_query($conn, $insert_cav);

				
			}
		}
		echo 'success';
		

	}
}


if (isset($_POST['btn_bl'])) {
	$b_sop = mysqli_real_escape_string($conn, $_POST['sop']);

	$sop_list_b = mysqli_query($conn, "SELECT * FROM r_sop WHERE s_name='$b_sop'");
	$row = mysqli_fetch_assoc($sop_list_b);

	$workflow = $row['s_workflow'];
	$linebusiness = $row['s_linebusiness'];
	$b_queue = explode("\n", $_POST['d_queue']);


	$num_elements = count($b_queue);
	$current_iteration = 0;

	foreach ($b_queue as $queue) {
		$current_iteration++;

		$filter_queue = mysqli_real_escape_string($conn, $queue);

		if ($current_iteration == $num_elements) {
			addQueue($conn, $userid, $queue, $linebusiness, $workflow, $b_sop,$time,$date,$userid);
	        echo 'success';

	    } else {
	       	addQueue($conn, $userid, $queue, $linebusiness, $workflow, $b_sop,$time,$date,$userid);
	    }
	    header("location: ../tracker_distro.php");
	}
}




?>