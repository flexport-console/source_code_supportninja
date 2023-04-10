<?php 
try {
  //$conn = new mysqli("localhost","u607775271_flexpor_db","Markkiler123!","u607775271_flexpor_db");
  $conn = new mysqli("localhost","root","","flexport_new");
  //$conn = new mysqli("sql590.main-hosting.eu","u607775271_flexpor_db","Markkiler123!","u607775271_flexpor_db");
  // Check connection
  if ($conn -> connect_errno) {
  header("location: ../403.php");
    exit();
  }

} catch (Exception $e) {
  header("location: ../403.php");
}
session_start();
$userid = $_SESSION['user_id'];
$user_id = $_SESSION['user_id'];

date_default_timezone_set('asia/manila');
$time = date("H:i:s");
$date = date("F d, Y");

?>