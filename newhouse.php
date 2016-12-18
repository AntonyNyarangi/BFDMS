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
$housename = trim($_POST['housename']);
$capacity = trim($_POST['capacity']);
$defaultstatus = 0;

//push values into db using query

//check if houseName is taken
$sqlcheck = "SELECT hseName FROM Houses WHERE hseName = '$housename'";
$result = $con->query($sqlcheck);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
  $hsenameexistserror = "A House with that name already exists";
  	echo "<script type='text/javascript'>alert('$hsenameexistserror');</script>";
}else{
  $sqlinsert = "INSERT INTO `Houses` (`hse_ID`, `hseName`, `max_Capacity`, `Status`) VALUES (NULL, '$housename', '$capacity', '$defaultstatus')";
  if ($con->query($sqlinsert)=== TRUE){
    $successfulMsg = "House created";
    header("Location:viewhouses.php?Message=".$successfulMsg);
  }else{
    // $errorMsg = "An error occured";
    echo "Error: " . $sqlinsert . "<br>" . $con->error;
    header("Location: newhouse.html?Message=".$errorMsg);
  }
}
?>
