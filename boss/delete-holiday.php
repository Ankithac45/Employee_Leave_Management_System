<?php 

require_once "../connection.php";

$holiday_id =  $_GET["holiday_id"];

$sql = "DELETE FROM holiday WHERE holiday_id = $holiday_id ";

mysqli_query($conn , $sql); 

header("Location: manage-holiday.php?delete-success-where-id=" .$holiday_id );


?>
