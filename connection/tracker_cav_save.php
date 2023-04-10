<?php 
include 'function.php';

if (isset($_POST['cav_btn']) && $_POST['cav_btn']=='cav_btn') {
	$cav_id = mysqli_real_escape_string($conn, $_POST['cav_id']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);
	$firmscode = mysqli_real_escape_string($conn, (isset($_POST['firmscode'])) ? "TRUE" : "FALSE" );
	$arrival_notice = mysqli_real_escape_string($conn, (isset($_POST['arrival_notice'])) ? "TRUE" : "FALSE" );
	$it_number = mysqli_real_escape_string($conn, (isset($_POST['it_number'])) ? "TRUE" : "FALSE" );
	$mbl_mawb = mysqli_real_escape_string($conn, (isset($_POST['mbl_mawb'])) ? "TRUE" : "FALSE" );
	$hbl_hawb = mysqli_real_escape_string($conn, (isset($_POST['hbl_hawb'])) ? "TRUE" : "FALSE" );
	$hblr = mysqli_real_escape_string($conn, (isset($_POST['hblr'])) ? "TRUE" : "FALSE" );
	$ci_pl = mysqli_real_escape_string($conn, (isset($_POST['ci_pl'])) ? "TRUE" : "FALSE" );
	$carrier = mysqli_real_escape_string($conn, (isset($_POST['carrier'])) ? "TRUE" : "FALSE" );
	$partner = mysqli_real_escape_string($conn, (isset($_POST['partner'])) ? "TRUE" : "FALSE" );
	$dstruckingleg = mysqli_real_escape_string($conn, (isset($_POST['dstruckingleg'])) ? "TRUE" : "FALSE" );
	$deconsolidation = mysqli_real_escape_string($conn, (isset($_POST['deconsolidation'])) ? "TRUE" : "FALSE" );
	$action_item = mysqli_real_escape_string($conn, (isset($_POST['action_item'])) ? "TRUE" : "FALSE" );
	$dsplancustom = mysqli_real_escape_string($conn, (isset($_POST['dsplancustom'])) ? "TRUE" : "FALSE" );
	$dsconfirmdd = mysqli_real_escape_string($conn, (isset($_POST['dsconfirmdd'])) ? "TRUE" : "FALSE" );
	$cargo_manifest = mysqli_real_escape_string($conn, (isset($_POST['cargo_manifest'])) ? "TRUE" : "FALSE" );



	$select_cavid_q = "SELECT * FROM queue_cav WHERE cav_id='$cav_id' AND user_employee_id='$userid' AND cav_status!=''";
	$select_cavid_res_q = mysqli_query($conn, $select_cavid_q);


	if (mysqli_num_rows($select_cavid_res_q)>0) {
		$reupdate = "UPDATE queue_cav SET cav_status='$status',firmscode='$firmscode',arrival_notice='$arrival_notice',it_number='$it_number',mbl_mawb='$mbl_mawb',hbl_hawb='$hbl_hawb',hblr='$hblr ',ci_pl='$ci_pl',carrier='$carrier',partner='$partner',dstruckingleg='$dstruckingleg',deconsolidation='$deconsolidation',action_item='$action_item',dsplancustom='$dsplancustom',dsconfirmdd='$dsconfirmdd',cargo_manifest='$cargo_manifest' WHERE cav_id='$cav_id'";
		$update_res = mysqli_query($conn, $reupdate);
		if ($update_res) {
			echo "updated";
		}
	}else{
		$find_last = mysqli_query($conn, "SELECT * FROM queue_cav WHERE user_employee_id='$user_id' AND cav_date='$date' ORDER BY cav_end_time DESC LIMIT 1");
		$find_last_res = mysqli_fetch_assoc($find_last);
		$start_ = $find_last_res['cav_end_time'];


		$update = "UPDATE queue_cav SET cav_status='$status',cav_start_time='$start_',cav_end_time='$time',firmscode='$firmscode',arrival_notice='$arrival_notice',it_number='$it_number',mbl_mawb='$mbl_mawb',hbl_hawb='$hbl_hawb',hblr='$hblr',ci_pl='$ci_pl',carrier='$carrier',partner='$partner',dstruckingleg='$dstruckingleg',deconsolidation='$deconsolidation',action_item='$action_item',dsplancustom='$dsplancustom',dsconfirmdd='$dsconfirmdd',cargo_manifest='$cargo_manifest' WHERE cav_id='$cav_id'";
		$update_res = mysqli_query($conn, $update);

		if ($update_res) {
			echo "updated";
		}
	}

}


?>

