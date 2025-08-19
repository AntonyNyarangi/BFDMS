<?php
//create server and database connection constants
$server = "localhost";
$user = "root";
$password = "password";
$database = "PoultryFarmManagementSystem";

$con= new mysqli ($server,$user,$password, $database);

//Check server connection
if ($con->connect_error){
  die ("Failed to establish DB connection:". $con->connect_error);
}
//receive  values from user form and trim white spaces
$date = trim($_POST['date']);
$size = trim($_POST['size']);
$currentsize = $size;
$houseassigned = 0;
$defaultstatus = 0;

//push values into db using query
$sqlinsert = "INSERT INTO `Brood` (`BroodID`, `Date`, `InitialSize`, `CurrentSize`, `HouseAssigned`, `Status`) VALUES (NULL, '$date', '$size', '$currentsize', '$houseassigned', '$defaultstatus')";
if ($con->query($sqlinsert)=== TRUE){
  $successfulMsg = "Brood Registered";
  header("Location:viewbroods.php?Message=".$successfulMsg);
}else{
  // $errorMsg = "An error occured";
  echo "Error: " . $sqlinsert . "<br>" . $con->error;
  // header("Location: newbrood.html?Message=".$errorMsg);
}
?>
