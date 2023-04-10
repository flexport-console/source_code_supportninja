<?php 
include 'dbconnect.php';
include 'audit_trail.php';

if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['page']) && !empty($_GET['page'])) {
	$flexid = mysqli_real_escape_string($conn, $_GET['id']);
	$page = mysqli_real_escape_string($conn, $_GET['page']);

	$to_del = mysqli_query($conn, "SELECT q_flex_id FROM queue WHERE q_id='$flexid'");
	$to_del_res = mysqli_fetch_assoc($to_del);
	$flexes = $to_del_res['q_flex_id'];
	if (is_numeric($flexid)) {
		$del = "DELETE FROM queue WHERE q_id='$flexid'";
		$del_res = mysqli_query($conn, $del);
		if ($del_res) {


			// Audit Trail - Start
			$desc = "The Flex-".$flexes." was deleted by the user.";
			$category = "queue";
			audit_trail($conn, $user_id, $desc, $time, $date, $link_user, $ip, $category);
			// Audit Trail - End
			header("location: ../".$page.".php?delete=success");
		}
	}else{
		header("location: ../".$page.".php?delete=error");
	}
}
?>