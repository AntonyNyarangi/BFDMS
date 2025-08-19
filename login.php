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
}//else {
//	echo "Connected successfully <br />";
//}
//receive  values from user form and trim white spaces
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	$sql ="SELECT FirstName, LastName, Username, Password,Category FROM Users WHERE username = '$username'";
	$result = $con->query($sql);



	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()){
			if ($row['Password'] != $password){
				echo " Incorrect Password";
			}else{
				if ($row['Category'] == 'Manager'){
					header('Location: index.html');
				} else {
					header('Location: fwDashboard.php');
				}

			}
		}
	}else{
		echo "Login Failed, User not in the system";
		header ('Location: login.html');
	}
	$con->close();
//}
	?>
