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
$fname = trim($_POST['firstname']);
$lname = trim($_POST['lastname']);
$usrname = trim($_POST['username']);
$category = trim($_POST['category']);

// echo $fname;

//update Brood
$sqlupdate = "UPDATE `Users` SET `FirstName` = '$fname', `LastName` = '$lname', `Username` = '$usrname', `Category` = '$category' WHERE `Users`.`UserID` = '$userID'";


if ($con->query($sqlupdate)=== TRUE){
  $successfulMsg = "User details updated";
  header("Location:viewusers.php?Message=".$successfulMsg);
}else{
  $errorMsg = "An error occured, user details not updated";
  echo "Error: " . $sqlupdate . "<br>" . $con->error;
  header("Location: viewusers.php?Message=".$errorMsg);
}
?>
