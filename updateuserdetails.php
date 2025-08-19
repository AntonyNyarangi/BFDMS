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
$userID = trim($_POST['userID']);
$fname = trim($_POST['firstname']);
$lname = trim($_POST['lastname']);
$usrname = trim($_POST['username']);
$category = trim($_POST['category']);

// echo $userID;

//update Brood
$update = "UPDATE `Users` SET `FirstName` = '$fname', `LastName` = '$lname', `Username` = '$usrname', `Category` = '$category' WHERE `Users`.`UserID` = '$userID'";


if ($con->query($update)){
  $successfulMsg = "User details updated";
  header("Location:viewusers.php?Message=".$successfulMsg);
}else{
  $errorMsg = "An error occured, user details not updated";
  echo "Error: " . $update . "<br>" . $con->error;
  header("Location: viewusers.php?Message=".$errorMsg);
}
?>
