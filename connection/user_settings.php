<?php 
include 'dbconnect.php';
include 'audit_trail.php';
// error_reporting(0);
if (isset($_POST['acc_info'])) {
	$employeeID = $userid;
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);

	try {
		$update = "UPDATE users SET user_firstname='$firstname', user_lastname='$lastname', user_email='$email' WHERE user_employee_id='$employeeID'";
		$update_res = mysqli_query($conn, $update);

		if ($update_res) {
			$desc = "The user updates their information.";
			$category = "account";
			audit_trail($conn, $userid, $desc, $time, $date, $link_user, $ip, $category);
			header("location: ../user_settings.php?update=success");
		}else{
			$desc = "The user is attempting to update their information but encountering an error.";
			$category = "account";
			audit_trail($conn, $userid, $desc, $time, $date, $link_user, $ip, $category);
			header("location: ../user_settings.php?update=error");
		}
		
	} catch (Exception $e) {
		header("location: ../user_settings.php?update=error");
	}

}



if (isset($_POST['change_password'])) {
	$old = mysqli_real_escape_string($conn, $_POST['val-old-password']);
	$new = mysqli_real_escape_string($conn, $_POST['val-password']);
	$con = mysqli_real_escape_string($conn, $_POST['val-confirm-password']);


	$view = mysqli_query($conn, "SELECT user_password FROM users WHERE user_employee_id='$userid'");
	$view_row = mysqli_fetch_assoc($view);
	$password_hash = $view_row['user_password'];

	try {
		if (password_verify($old, $password_hash)) {
			$password_new_hash = password_hash($new, PASSWORD_DEFAULT);
			if (password_verify($con, $password_new_hash)) {
				$update_pass = "UPDATE users SET user_password='$password_new_hash' WHERE user_employee_id='$userid'";
				$update_pass_res = mysqli_query($conn, $update_pass);
				if ($update_pass_res) {
					$desc = "The user's password has been changed.";
					$desc = mysqli_real_escape_string($conn, $desc);
					$category = "account";
					audit_trail($conn, $userid, $desc, $time, $date, $link_user, $ip, $category);
					header("location: ../user_settings.php?password=success");
				}
			}else{
				$desc = "The user is attempting to changed their password but encountering an error.";
				$category = "account";
				audit_trail($conn, $userid, $desc, $time, $date, $link_user, $ip, $category);
				header("location: ../user_settings.php?password=error_occured");
			}
		}else{	
			$desc = "The user is attempting to changed their password but the old is incorrect.";
			$category = "account";
			audit_trail($conn, $userid, $desc, $time, $date, $link_user, $ip, $category);
			header("location: ../user_settings.php?password=incorrect_password");
		}

	} catch (Exception $e) {
		$desc = "The user is attempting to changed their password but encountering an error.";
		$category = "account";
		audit_trail($conn, $userid, $desc, $time, $date, $link_user, $ip, $category);
		header("location: ../user_settings.php?password=error_occured");
	}

}



?>