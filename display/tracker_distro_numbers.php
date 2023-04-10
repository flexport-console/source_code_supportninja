<?php 
include '../connection/dbconnect.php';
if ($conn) {
    echo "success";
}else{
    echo "login";
}
?>