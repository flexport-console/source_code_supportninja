<?php 
include 'dbconnect.php';
include 'audit_trail.php';

function deleted($conn, $table,$column, $employee_id, $name, $ip, $link_user,$date,$time,$user_id){
	$delete_res = mysqli_query($conn, "DELETE FROM $table WHERE $column='$name' AND user_employee_id='$employee_id'");
	if ($delete_res) {
		// Audit Trail - Start
		$desc = $employee_id."'s ".$name." was deleted by the user.";
		$desc = mysqli_real_escape_string($conn, $desc);
		$category = "resources";
		audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
		// Audit Trail - End
		return true;
	}
}


if (isset($_GET['delete']) && !empty($_GET['delete']) && isset($_GET['q']) && !empty($_GET['q']) && isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
		
	$delete = mysqli_real_escape_string($conn, $_GET['delete']);
	$q = mysqli_real_escape_string($conn, $_GET['q']);
	$employee_id = mysqli_real_escape_string($conn, $_GET['employee_id']);
	if ($delete=="linebusiness") {
		$table = "users_linebusiness";
		$column = "ul_linebusiness";

	
		if (deleted($conn, $table, $column, $employee_id,$q,$ip, $link_user, $date, $time,$user_id)) {
			header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=success");
		}	
	}elseif ($delete=="workflow") {
		$table = "users_workflow";
		$column = "wl_name";

		deleted($conn, $table, $column, $employee_id,$q,$ip, $link_user, $date, $time,$user_id);

		// to delete also automatic all SOP under WORKFLOW
		$view_automation = mysqli_query($conn, "SELECT * FROM r_sop WHERE s_workflow='$q'");

		if (mysqli_num_rows($view_automation)>0) {
			$table = "users_sop";
			$column = "sop_name";
			while ($row = mysqli_fetch_assoc($view_automation)) {
				$heheheh = $row['s_name'];
				deleted($conn, $table, $column, $employee_id, $heheheh,$ip, $link_user, $date, $time,$user_id);
			}
			header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=success");
		}



	}elseif ($delete=="sop") {
		$table = "users_sop";
		$column = "	sop_name";
		if (deleted($conn, $table, $column, $employee_id,$q,$ip, $link_user, $date, $time,$user_id)) {
			header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=success");
		}	
	}
}



if (isset($_GET['roleid']) && !empty($_GET['roleid']) && isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
	$roleid = mysqli_real_escape_string($conn, $_GET['roleid']);
	$employee_id = mysqli_real_escape_string($conn, $_GET['employee_id']);

	$view_check_role = "SELECT * FROM user_role WHERE role_id='$roleid' AND user_employee_id='$employee_id'";
	$view_check_role_res = mysqli_query($conn, $view_check_role);

	if (mysqli_num_rows($view_check_role_res)>0) {
		$toDeleterole = "DELETE FROM user_role WHERE role_id='$roleid' AND user_employee_id='$employee_id'";
		$toDeleteroleRes = mysqli_query($conn, $toDeleterole);

		if ($toDeleteroleRes) {
			header("location: ../user_profile.php?user=".$employee_id."&view=edit&role=success");
		}else{
			header("location: ../user_profile.php?user=".$employee_id."&view=edit&role=error");
		}
	}
}


if (isset($_GET['trackerid']) && !empty($_GET['trackerid']) && isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
	$trackerid = mysqli_real_escape_string($conn, $_GET['trackerid']);
	$employee_id = mysqli_real_escape_string($conn, $_GET['employee_id']);

	$view_check_role = "SELECT * FROM user_tracker WHERE tr_id='$trackerid' AND user_employee_id='$employee_id'";
	$view_check_role_res = mysqli_query($conn, $view_check_role);

	if (mysqli_num_rows($view_check_role_res)>0) {
		$toDeleterole = "DELETE FROM user_tracker WHERE tr_id='$trackerid' AND user_employee_id='$employee_id'";
		$toDeleteroleRes = mysqli_query($conn, $toDeleterole);

		if ($toDeleteroleRes) {
			header("location: ../user_profile.php?user=".$employee_id."&view=edit&tracker=success");
		}else{
			header("location: ../user_profile.php?user=".$employee_id."&view=edit&tracker=error");
		}
	}
}


?>