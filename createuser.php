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
$fname = trim($_POST['firstname']);
$lname = trim($_POST['lastname']);
$usrname = trim($_POST['username']);
$category = trim($_POST['category']);
$defaultPassword = 123456;

//push values into db using query

//check if username is taken
$sqlcheck = "SELECT UserID FROM Users WHERE Username = '$usrname'";
$result = $con->query($sqlcheck);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
  $userexistserror = "That username is taken";
  header('Location: createUser.html');
  echo "That username is taken";
  $UserID = $row['UserID'];
}else{
  $sqlinsert = "INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Category`, `Username`, `Password`) VALUES (NULL, '$fname', '$lname', '$category', '$usrname', '$defaultPassword')";
  if ($con->query($sqlinsert)=== TRUE){
    $successfulMsg = "User created";
    echo "<script type = 'text/javascript'>alert('$successfulMsg');</script>";
    header('Location: viewusers.php');
  }else{
    $errorMsg = "An error occured";
    echo "Error: " . $sqlinsert . "<br>" . $con->error;
    echo "<script type = 'text/javascript'>alert('$errorMsg');</script>";
    header('Location: createuser.php');
  }
}

?>
