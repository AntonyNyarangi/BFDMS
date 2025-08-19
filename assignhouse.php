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
$hse_ID = trim($_POST['houseID']);

// echo $hse_ID;

//update Brood
$sqlupdate = "UPDATE `Brood` SET `HouseAssigned` = '$hse_ID' WHERE `Brood`.`BroodID` = '$broodID'";
$sqlupdate2 = "UPDATE `Houses` SET `Status` = '1' WHERE `Houses`.`hse_ID` = '$hse_ID'";

if ($con->query($sqlupdate)=== TRUE && $con->query($sqlupdate2)=== TRUE ){
  $successfulMsg = "House Assigned";
  header("Location:viewbroods.php?Message=".$successfulMsg);
}else{
  $errorMsg = "An error occured";
  echo "Error: " . $sqlupdate . "<br>" . $con->error;
  header("Location: newbrood.php?Message=".$errorMsg);
}
?>
