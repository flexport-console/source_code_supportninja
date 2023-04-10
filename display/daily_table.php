<?php 
include '../connection/function.php';


$search_date = $_SESSION['searchDate'];


if (isset($userid) && isset($search_date)) {
	$daily_table = "SELECT * FROM queue WHERE q_date='$search_date' AND user_employee_id='$userid'";
	$daily_table_res = mysqli_query($conn, $daily_table);
}

?>

<div>
	<?php 
	if (mysqli_num_rows($daily_table_res)>0) {
		while ($row = mysqli_fetch_assoc($daily_table_res)) {
	?>
	<tr>
		<td><?php echo $row['q_flex_id']; ?></td>
		<td><?php echo $row['q_lineofbusiness']; ?></td>
		<td><?php echo $row['q_workflow']; ?></td>
		<td><?php echo $row['q_sop']; ?></td>
		<td><?php echo $row['q_status']; ?></td>
		<td><?php echo $row['q_remarks']; ?></td>
		<td><?php timeDiff($row['q_start_time'],$row['q_end_time']);  ?></td>
		<td><?php echo $row['q_shipment']; ?></td>
	</tr>
	<?php
		}
	}else{ 
	?>
	<tr>
		<td colspan="8" class="text-center"></td>
	</tr>

	<?php
	}
	?>
</div>