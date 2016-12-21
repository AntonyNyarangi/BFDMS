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
$date = trim($_POST['date']);
$feedID = trim($_POST['feedType']);
$houseID = trim($_POST['houseSelector']);
$amount = trim($_POST['amount']);
$remark = trim($_POST['remark']);

// $sql0 = "SELECT hse_ID FROM Houses WHERE hseName = '$house'";
// $result = $con->query($sql0);
// $row = $result->fetch_assoc();
// $houseID = $row['hse_ID'];

// $sql4 = "SELECT feed_ID FROM Feed WHERE feed_Type = '$type'";
// $feedResult = $con->query($sql4);
// $feedRow = $feedResult->fetch_assoc();
// $feedID = $feedRow['feed_ID'];

$sql1 = "SELECT * FROM FeedConsumption WHERE date = '$date' AND hse_ID = '$houseID'";
$sql1Result = $con->query($sql1);
$sql1Row = $sql1Result->fetch_assoc();
$resultDate = $sql1Row['date'];
$entry_ID = $sql1Row['entry_ID'];
$hseID = $sql1Row['hse_ID'];
$feedtype = $sql1Row['feed_ID'];


if ($date == $resultDate && $hseID == $houseID && $feedtype == $type){
	$sql2 = "UPDATE `FeedConsumption` SET `feed_ID` = '$feedID', amount = '$amount' , remark = '$remark' WHERE entry_ID = '$entry_ID'";
	if ($con->query($sql2) === TRUE) {
		$successfulUpdateMsg = "Entry Updated Successfuly";
		echo "<script type='text/javascript'>alert('$successfulUpdateMsg');</script>";
		//header('Location: mortality.html');
	} else {
		echo "Error: " . $sql2 . "<br>" . $con->error;
		header("Location:feedConsumptionADMIN.php");
	}
}else{

	$sql3 = "INSERT INTO FeedConsumption(date, feed_ID, hse_ID, amount, remark) VALUES ('$date', '$feedID', '$houseID', '$amount', '$remark')";
	if ($con->query($sql3) === TRUE) {
		$successfulSaveMsg = "Entry Saved Successfuly";
		echo "<script type='text/javascript'>alert('$successfulSaveMsg');</script>";
		// header("Location:feedConsumptionADMIN.php");
	} else {
		echo "Error: " . $sql3 . "<br>" . $con->error;
	}
}
?>
