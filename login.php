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
}//else {
//	echo "Connected successfully <br />";
//}
//receive  values from user form and trim white spaces
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

// <!if (empty($username)){
// 	echo "Please enter your username";
// }else if (empty($password)){
// 	echo "Please enter your password";	
// }else{
	$sql ="SELECT FirstName, LastName, Username, Password,Category FROM Users WHERE username = '$username'";
	$result = $con->query($sql);



	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()){
			if ($row['Password'] != $password){
				echo " Incorrect Password";
			}else{
				if ($row['Category'] == 'Admin'){
					header('Location: index.html');
				} else {
					echo "you are not admin";
					header('Location: fwDashboard.html');
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
