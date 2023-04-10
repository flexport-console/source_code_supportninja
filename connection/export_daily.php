<?php
// Database connection
include 'dbconnect.php';

$search_date = $_SESSION['searchDate'];
// Fetch data from database
$sql = "SELECT * FROM queue WHERE user_employee_id='$userid' AND q_date='$search_date' AND q_status!='break'";
$result = mysqli_query($conn, $sql);

// Create CSV file
$filename = $userid."_".$search_date.".csv";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$fp = fopen('php://output', 'w');

// Write column headers to CSV file
$headers = array('Employee ID', 'Flex-ID', 'Status', 'Remarks', 'Line of Business', 'Workflow', 'SOP', 'Date', 'Start Time', 'End Time','Shipment');
fputcsv($fp, $headers);

// Write data to CSV file
while ($row = mysqli_fetch_assoc($result)) {
    $data = array($row['user_employee_id'], $row['q_flex_id'], $row['q_status'], $row['q_remarks'], $row['q_lineofbusiness'], $row['q_workflow'], $row['q_sop'], $row['q_date'], $row['q_start_time'], $row['q_end_time'], $row['q_shipment']);
    fputcsv($fp, $data);
}

// Close CSV file and database connection
fclose($fp);
mysqli_close($conn);

exit;
?>