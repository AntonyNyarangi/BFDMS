<?php
//create server and database connection constants
$server = "localhost:3306";
$user = "root";
$password = "abcd1234";
$database = "PoultryFarmManagementSystem";

$con= new mysqli ($server,$user,$password, $database);

//Check server connection
if ($con->connect_error){
  die ("Failed to establish DB connection:". $con->connect_error);
}
//receive  values from user form and trim white spaces
$broodID = trim($_POST['broodID']);

//delete query

$sql = "DELETE FROM `Brood` WHERE `BroodID` = $broodID";

if (  $con->query("UPDATE Houses Set Houses.Status = '0'WHERE Houses.hse_ID = (SELECT HouseAssigned From Brood WHERE Brood.BroodID = $broodID)")=== TRUE && $con->query($sql)=== TRUE){
  $successfulMsg = "Brood Deleted";
  header("Location:viewbroods.php?Message=".$successfulMsg);
}else{
  $errorMsg = "An error occured";
  echo "Error: " . $sql . "<br>" . $con->error;
  echo "<script type = 'text/javascript'>alert('$errorMsg');</script>";
}
?>
