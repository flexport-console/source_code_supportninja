<?php 
//  SELECTION MODAL
$workflow_select = mysqli_query($conn, "SELECT * FROM r_linebusiness");
$sop_linebusiness_select =  mysqli_query($conn, "SELECT * FROM r_linebusiness");
$sop_linebusiness_select_nested = mysqli_query($conn, "SELECT * FROM r_linebusiness");
$remarks_linebusiness_select_nested = mysqli_query($conn, "SELECT * FROM r_linebusiness");
$remarks_status_select = mysqli_query($conn, "SELECT * FROM r_status");
$remarks_status_workflow_select = mysqli_query($conn, "SELECT * FROM r_linebusiness");

//  Display Data to Table
$linebusiness_table = mysqli_query($conn, "SELECT r.line_name as linebusiness, CONCAT(u.user_firstname,' ',u.user_lastname) as full_name FROM r_linebusiness r LEFT JOIN users u ON r.line_added_by = u.user_employee_id");
$workflow_table = mysqli_query($conn, "SELECT w.w_name as workflow, w.w_linebusiness as linebusiness, CONCAT(u.user_firstname,' ',u.user_lastname) as full_name FROM r_workflow w LEFT JOIN users u ON w.w_added_by = u.user_employee_id");
$sop_table = mysqli_query($conn, "SELECT * FROM r_sop");
$remarks_table = mysqli_query($conn, "SELECT * FROM r_remarks");
$status_table = mysqli_query($conn, "SELECT st.st_name as status,st.st_workflow as workflow, CONCAT(u.user_firstname,' ',u.user_lastname) as full_name FROM r_status st LEFT JOIN users u ON st.st_added_by = u.user_employee_id");








?>