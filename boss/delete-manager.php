<?php 

require_once "../connection.php";

$id =  $_GET["id"];

$sql = "DELETE FROM manager WHERE id = $id ";

mysqli_query($conn , $sql); 

header("Location: manage-manager.php?delete-success-where-id=" .$id );


?>
