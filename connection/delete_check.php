<?php 
include 'function.php';
include 'audit_trail.php';
if (!empty($_POST['myArray'])) {
	$myArray = $_POST['myArray'];
	foreach ($myArray as $key) {
		$delete = "DELETE FROM queue WHERE q_id='$key'";
		$deleted = mysqli_query($conn, $delete);
		if ($deleted) {
			echo "deleted";
		}else{
			echo "error";
		}
	}
}else{
	echo "error";
}


	
?>