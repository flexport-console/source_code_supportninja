<?php 
include 'dbconnect.php';
include 'audit_trail.php';

if (isset($_POST['button'])) {
	$employeeid = mysqli_real_escape_string($conn, $_POST['val-username']);
	$pass = mysqli_real_escape_string($conn, $_POST['val-password']);

	if (empty($employeeid) || empty($pass)) {
		header("location: ../login.php?field=empty");
	}else{
		$validate_user = "SELECT * FROM users WHERE user_employee_id='$employeeid'";
		$validate_user_res = mysqli_query($conn, $validate_user);

		if (mysqli_num_rows($validate_user_res)>0) {
			$user_information = mysqli_fetch_assoc($validate_user_res);
			$password_hash = $user_information['user_password'];
			$user_status = $user_information['user_status'];
			if (password_verify($pass, $password_hash)) {
				if ($user_status =="locked") {
					header("location: ../login.php?status=locked");
				}else{
					$_SESSION['logged_in'] = "active";
					$_SESSION['user_id'] = $user_information['user_employee_id'];
					// Audit Trail - Start
					$desc = "The user has logged in.";
					$category = "login";
					audit_trail($conn, $employeeid, $desc, $time, $date, $link_user, $ip, $category);
					// Audit Trail - End
					header("location: ../index.php");
				}
			}else{
				header("location: ../login.php?status=incorrect");
			}
		}else{
			header("location: ../login.php?status=notfound");
		}
	}
}else{
	header("location: ../login.php");
}

?>