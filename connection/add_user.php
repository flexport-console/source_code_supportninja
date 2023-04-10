<?php 
include 'dbconnect.php';
include 'audit_trail.php';

function editProfile($conn, $user_id,$user_employee_id,$email,$firstname,$lastname,$supervisor,$position,$status, $ip, $link_user, $date, $time){

	$view_old = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$user_id'");
	$view_old_num = mysqli_fetch_assoc($view_old);

	$employee_old = $view_old_num['user_employee_id'];


	$update = "UPDATE users SET user_employee_id='$user_employee_id', user_email='$email', user_firstname='$firstname', user_lastname='$lastname', user_supervisor_id='$supervisor', user_status='$status', user_position='$position' WHERE user_id='$user_id'";
	$update_res = mysqli_query($conn, $update);
	if ($update_res) {


		if ($position== "Team Manager" || $position=="Operations Manager" || $position=="Director") {
			$update_manager = "UPDATE users SET user_supervisor_id='$user_employee_id' WHERE user_supervisor_id='$employee_old'";
			$update_manager_res = mysqli_query($conn, $update_manager);
		}




		$desc = $user_employee_id." profile is being edited by the user.";
		$category = "account";
		audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
		return true;
	}
}


function autoInsert($conn, $user_id, $sop_name, $added_by, $ip, $link_user, $date, $time){
	$insert = "INSERT INTO users_sop VALUES (null,'$user_id','$sop_name','$added_by')";
	$insert_res = mysqli_query($conn, $insert);
	if ($insert_res) {
		return true;
	}
}


if (isset($_POST['add_user'])) {
	$employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$team_manager = mysqli_real_escape_string($conn, $_POST['team_manager']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$linebusiness = mysqli_real_escape_string($conn, $_POST['linebusiness']);
	$password = '$2y$10$RlLf6m6E9Pcm8o5rtqSG/uZcggGPMFq5OMjq4sRzq1E9C8AQI7CZO';
	$employee_id_search = "SELECT * FROM users WHERE user_employee_id='$employee_id'";
	$employee_id_search_res = mysqli_query($conn, $employee_id_search);

	if (mysqli_num_rows($employee_id_search_res)>0) {
		header("location: ../users.php?user=already");
	}else{
		if (empty($employee_id) || empty($email) || empty($first) || empty($last) || empty($team_manager) || empty($position)) {
			header("location: ../users.php?error=error");
		}else{
			$insert_new = "INSERT INTO users VALUES (null,'$employee_id','$password','$email','$first','$last','$team_manager', 'active','$position')";
			$insert_new_res = mysqli_query($conn, $insert_new);
			if ($insert_new_res) {

				$insert_linebusiness = "INSERT INTO users_linebusiness VALUES (null, '$employee_id', '$linebusiness','$userid')";
				$insert_linebusiness_res = mysqli_query($conn, $insert_linebusiness);

				if ($insert_linebusiness_res) {
					$desc = "The user add new ninja EmployeeID: ".$employee_id;
					$category = "account";
					audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
					header("location: ../users.php?user=success");
				}
			}
		}
	}
}


if (isset($_POST['btn_edit'])) {
	$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
	$employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$team_manager = mysqli_real_escape_string($conn, $_POST['team_manager']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);

	if (empty($user_id) || empty($employee_id) || empty($email) || empty($firstname) || empty($lastname) || empty($team_manager) || empty($position) || empty($status)) {
		header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=error");
	}else{
		if (editProfile($conn, $user_id, $employee_id, $email, $firstname, $lastname, $team_manager, $position, $status,$ip, $link_user, $date, $time)) {
			header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=success");
		}
	}

}


if (isset($_POST['btn_lob'])) {
	$employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
	$linebusiness = mysqli_real_escape_string($conn, $_POST['line_business']);

	$check_ass = "SELECT * FROM users_linebusiness WHERE ul_linebusiness='$linebusiness' AND user_employee_id='$employee_id'";
	$check_ass_res = mysqli_query($conn, $check_ass);


	if (!mysqli_num_rows($check_ass_res)>0) {
		$insert = "INSERT INTO users_linebusiness VALUES (null, '$employee_id', '$linebusiness', '$userid')";
		$insert_res = mysqli_query($conn, $insert);
		if ($insert_res) {

			// Audit Trail - Start
			$desc = "Line of business was assigned to ".$employee_id." by the user, and Line of business is ".$linebusiness.".";
			$category = "account";
			audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
			// Audit Trail - End

			header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=success");
		}
	}else{
		header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=already");
	}
}

if (isset($_POST['btn_workflow'])) {
	$employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
	$workflow = mysqli_real_escape_string($conn, $_POST['workflow']);

	$check_ass = "SELECT * FROM users_workflow WHERE wl_name='$workflow' AND user_employee_id='$employee_id'";
	$check_ass_res = mysqli_query($conn, $check_ass);

	if (!mysqli_num_rows($check_ass_res)>0) {
		$insert = "INSERT INTO users_workflow VALUES (null, '$employee_id', '$workflow', '$userid')";
		$insert_res = mysqli_query($conn, $insert);
		if ($insert_res) {
			// Audit Trail - Start
			$desc = "Workflow was assigned to ".$employee_id." by the user, and Workflow is ".$workflow.".";
			$category = "account";
			audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
			// Audit Trail - End
			$auto_insert = "SELECT * FROM r_sop WHERE s_workflow='$workflow'";
			$auto_insert_res = mysqli_query($conn, $auto_insert);


			if (mysqli_num_rows($auto_insert_res)>0) {
				while ($row = mysqli_fetch_assoc($auto_insert_res)) {
					if (autoInsert($conn, $employee_id, $row['s_name'], $userid,$ip, $link_user, $date, $time)) {
						header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=success");
					}
				}
			}	
		}
	}else{
		header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=already");
	}
}



if (isset($_POST['btn_sop'])) {
	$employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
	$sop = mysqli_real_escape_string($conn, $_POST['sop']);

	$check_ass = "SELECT * FROM users_sop WHERE sop_name='$sop' AND user_employee_id='$employee_id'";
	$check_ass_res = mysqli_query($conn, $check_ass);

	if (!mysqli_num_rows($check_ass_res)>0) {
		$insert = "INSERT INTO users_sop VALUES (null, '$employee_id', '$sop', '$userid')";
		$insert_res = mysqli_query($conn, $insert);
		
		if ($insert_res) {
			header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=success");
		}
	}else{
		header("location: ../user_profile.php?user=".$employee_id."&view=edit&update=already");
	}
}



?>