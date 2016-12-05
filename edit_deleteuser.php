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
//receive  values from user form and trim white spaces
$userID = trim($_POST['userID']);

//push values into db using query

$sql = "DELETE FROM `Users` WHERE `UserID` = $userID";

if ($con->query($sql)=== TRUE){
  $successfulMsg = "User deleted";
  echo "<script type = 'text/javascript'>alert('$successfulMsg');</script>";
}else{
  $errorMsg = "An error occured";
  echo "Error: " . $sql . "<br>" . $con->error;
  echo "<script type = 'text/javascript'>alert('$errorMsg');</script>";
}
$successfulMsg = "User deleted";
header("Location:viewusers.php?Message=".$successfulMsg);
?>
