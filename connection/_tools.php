<?php 
include 'dbconnect.php';



if (isset($_POST['rolebtn'])) {
	$employeeid = mysqli_real_escape_string($conn, $_POST['employeeid']);
	$role = implode(",", $_POST['role']);
	$roles = explode(",", $role);

	foreach ($roles as $key) {
		$user_role = mysqli_real_escape_string($conn, $key);

		$existing_role = mysqli_query($conn, "SELECT * FROM user_role WHERE role_name='$user_role' AND user_employee_id='$employeeid'");


		if (mysqli_num_rows($existing_role)>0) {
			header("location: ../_tools.php?role=success");
		}else{
			$insert_role = "INSERT INTO user_role VALUES (null, '$employeeid','$user_role','$userid')";
			$insert_role_res = mysqli_query($conn, $insert_role);
			if ($insert_role_res) {
			}else{
				header("location: ../_tools.php?role=error");
			}
		}
		header("location: ../_tools.php?role=success");
	}
}


if (isset($_POST['trackerbtn'])) {
	$employeeid = mysqli_real_escape_string($conn, $_POST['employeeid']);
	$tracker = mysqli_real_escape_string($conn, $_POST['tracker']);

	$view_tracker = mysqli_query($conn, "SELECT * FROM user_tracker WHERE tr_name='$tracker' AND user_employee_id='$employeeid'");
	if (mysqli_num_rows($view_tracker)>0) {
		header("location: ../_tools.php?tracker=tracker");
	}else{
		$insert_tracker = "INSERT INTO user_tracker VALUES (null, '$employeeid','$tracker','$userid')";
		$insert_tracker_res = mysqli_query($conn, $insert_tracker);

		if ($insert_tracker_res) {
			header("location: ../_tools.php?tracker=success");
		}

	}
}
?>