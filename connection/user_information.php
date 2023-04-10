<?php 
include 'dbconnect.php';
error_reporting(0);
date_default_timezone_set('asia/manila');
$month = date("F"); // Current Month
$date = date("F d, Y"); // Current Month

$user_employee_id = $_SESSION['user_id'];


$user_view = "SELECT e.user_employee_id as employeeID, e.user_firstname as firstname, e.user_email as email, e.user_lastname as lastname,e.user_position as position, CONCAT(m.user_firstname,' ',m.user_lastname) as Manage_name FROM users e INNER JOIN users m ON e.user_supervisor_id=m.user_employee_id WHERE 
	e.user_employee_id='$user_employee_id'";
$user_view_res = mysqli_query($conn, $user_view);
$user_information = mysqli_fetch_assoc($user_view_res);


$user_works = "";

if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in']!="active") {
	header("location: login.php");
}


$_roles = array();

$users_role = "SELECT * FROM user_role WHERE user_employee_id='$userid'";
$users_role_res = mysqli_query($conn, $users_role);
if (mysqli_num_rows($users_role_res)>0) {
	while ($access_row = mysqli_fetch_assoc($users_role_res)) {
		array_push($_roles, $access_row['role_name']);
	}
}


$_tracker = array();

$users_tracker = "SELECT * FROM user_tracker WHERE user_employee_id='$userid'";
$users_tracker_res = mysqli_query($conn, $users_tracker);
if (mysqli_num_rows($users_tracker_res)>0) {
	while ($tracker_row = mysqli_fetch_assoc($users_tracker_res)) {
		array_push($_tracker, $tracker_row['tr_name']);
	}
}

?>