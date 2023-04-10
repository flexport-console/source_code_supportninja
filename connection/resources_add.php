<?php 
include 'dbconnect.php';
include 'audit_trail.php';
// $userid
if (isset($_POST['btn_line'])) {
	$linebusiness_temp = mysqli_real_escape_string($conn, ucfirst($_POST['linebusiness']));
	$linebusiness = preg_replace("/[^A-Za-z\d+\s\#\&\-\.\/]/", "", $linebusiness_temp);
	if (!empty($linebusiness)) {

		$linebusiness_look = mysqli_query($conn, "SELECT * FROM r_linebusiness WHERE line_name='$linebusiness'");

		if (mysqli_num_rows($linebusiness_look)>0) {
			header("location: ../resources.php?added=already");
		}else{
			$linebusiness_insert = mysqli_query($conn, "INSERT INTO r_linebusiness VALUES (null,'$linebusiness','$userid')");
			if ($linebusiness_insert) {
				// Audit Trail - Start
				$desc = "The user add new line of business called ".$linebusiness;
				$category = "resources";
				audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
				// Audit Trail - End
				header("location: ../resources.php?added=success");
			}
		}
	}
}


if (isset($_POST['btn_workflow'])) {
	$workflow_temp = mysqli_real_escape_string($conn, ucfirst($_POST['workflow']));
	$workflow = preg_replace("/[^A-Za-z\d+\s\#\&\-\.\/]/", "", $workflow_temp);
	$linebusiness = mysqli_real_escape_string($conn, ucfirst($_POST['linebusiness']));
	if (!empty($linebusiness) && !empty($workflow)) {

		$workflow_look = mysqli_query($conn, "SELECT * FROM r_workflow WHERE w_name='$workflow' AND w_linebusiness='$linebusiness'");

		if (mysqli_num_rows($workflow_look)>0) {
			header("location: ../resources.php?added=already");
		}else{
			$workflow_insert = mysqli_query($conn, "INSERT INTO r_workflow VALUES (null, '$workflow','$linebusiness','$userid')");
			if ($workflow_insert) {
				// Audit Trail - Start
				$desc = "The user add new workflow called ".$workflow;
				$category = "resources";
				audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
				// Audit Trail - End
				header("location: ../resources.php?added=success");
			}
		}
	}
}


if (isset($_POST['btn_sop'])) {
	$sop_temp = mysqli_real_escape_string($conn, ucfirst($_POST['sop']));
	$sop = preg_replace("/[^A-Za-z\d+\s\#\&\-\.\/]/", "", $sop_temp);
	$workflow = mysqli_real_escape_string($conn, ucfirst($_POST['workflow']));
	$linebusiness = mysqli_real_escape_string($conn, ucfirst($_POST['linebusiness']));
	if (!empty($linebusiness) && !empty($workflow) && !empty($sop)) {

		$sop_look = mysqli_query($conn, "SELECT * FROM r_sop WHERE s_name='$sop' AND s_name='$workflow' AND s_linebusiness='$linebusiness'");

		if (mysqli_num_rows($sop_look)>0) {
			header("location: ../resources.php?added=already");
		}else{
			$sop_insert = mysqli_query($conn, "INSERT INTO r_sop VALUES (null,'$sop','$linebusiness','$workflow','$userid')");
			if ($sop_insert) {
				// Audit Trail - Start
				$desc = "The user add new SOP called ".$sop;
				$category = "resources";
				audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
				// Audit Trail - End
				header("location: ../resources.php?added=success");
			}
		}
	}
}


if (isset($_POST['btn_remarks'])) {
	$remarks_temp = mysqli_real_escape_string($conn, ucfirst($_POST['remarks']));
	$remarks = preg_replace("/[^A-Za-z\d+\s\#\&\-\.\/]/", "", $remarks_temp);
	$workflow = mysqli_real_escape_string($conn, ucfirst($_POST['workflow']));
	$status = mysqli_real_escape_string($conn, ucfirst($_POST['status']));
	if (!empty($remarks) && !empty($workflow) && !empty($status)) {

		$remarks_look = mysqli_query($conn, "SELECT * FROM r_remarks WHERE r_name='$remarks' AND r_name='$workflow' AND r_status='$status'");

		if (mysqli_num_rows($remarks_look)>0) {
			header("location: ../resources.php?added=already");
		}else{
			$remarks_insert = mysqli_query($conn, "INSERT INTO r_remarks VALUES (null,'$remarks','$workflow','$status','$userid')");
			if ($remarks_insert) {
				// Audit Trail - Start
				$desc = "The user add new remarks called ".$remarks;
				$category = "resources";
				audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
				// Audit Trail - End
				header("location: ../resources.php?added=success");
			}
		}
	}
}


if (isset($_POST['btn_status'])) {
	$status_temp = mysqli_real_escape_string($conn, ucfirst($_POST['status']));
	$workflow = mysqli_real_escape_string($conn, ucfirst($_POST['workflow']));
	$status = preg_replace("/[^A-Za-z\d+\s\#\&\-\.\/]/", "", $status_temp);
	if (!empty($status)) {

		$status_look = mysqli_query($conn, "SELECT * FROM r_status WHERE st_name='$sop'");

		if (mysqli_num_rows($status_look)>0) {
			header("location: ../resources.php?added=already");
		}else{
			$status_insert = mysqli_query($conn, "INSERT INTO r_status VALUES (null,'$status','$workflow','$userid')");
			if ($status_insert) {
				// Audit Trail - Start
				$desc = "The user add new status called ".$status;
				$category = "resources";
				audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
				// Audit Trail - End
				header("location: ../resources.php?added=success");
			}
		}
	}
}

?>