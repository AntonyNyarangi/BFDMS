<?php
//create server and database connection constants

$server = "localhost";
$user = "root";
$password = "48285";
$database = "BroilerFarmManagementSystem";

$con= new mysqli ($server,$user,$password, $database);

//Check server connection
if ($con->connect_error){
  die ("Failed to establish DB connection:". $con->connect_error);
}


$days = $con->query("SELECT DATEDIFF(NOW(),Date) as days From Brood Where BroodID = 13");
$row = $days->fetch_assoc();
echo $row['days'];
?>
