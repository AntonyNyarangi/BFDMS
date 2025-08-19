<?php
//create server and database connection constants
$server = "localhost:3306";
$user = "root";
$password = "@mokaya";
$database = "PoultryFarmManagementSystem";

$con= new mysqli ($server,$user,$password, $database);

//Check server connection
if ($con->connect_error){
  die ("Failed to establish DB connection:". $con->connect_error);
}
//receive  values from user form and trim white spaces
$houseID = trim($_POST['houseID']);

//delete query

$sql = "DELETE FROM `Houses` WHERE `hse_ID` = $houseID";

if ($con->query($sql)=== TRUE){
  $successfulMsg = "House deleted";
  echo "<script type = 'text/javascript'>alert('$successfulMsg');</script>";
}else{
  $errorMsg = "An error occured";
  echo "Error: " . $sql . "<br>" . $con->error;
  echo "<script type = 'text/javascript'>alert('$errorMsg');</script>";
}
$successfulMsg = "House deleted";
header("Location:viewhouses.php?Message=".$successfulMsg);
?>
