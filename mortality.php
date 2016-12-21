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
$number = trim($_POST['number']);
$houseID = trim($_POST['house']);
$remark = trim($_POST['remark']);

// $sql0 = "SELECT hse_ID FROM Houses WHERE hseName = '$house'";
// $result = $con->query($sql0);
// $row = $result->fetch_assoc();
// $houseID = $row['hse_ID'];

$sql1 = "SELECT * FROM Mortality WHERE date = '$date' AND hse_ID = '$houseID'";
$sql1Result = $con->query($sql1);
$sql1Row = $sql1Result->fetch_assoc();
$resultDate = $sql1Row['date'];
$entry_ID = $sql1Row['entry_ID'];
$hseID = $sql1Row['hse_ID'];


if ($date == $resultDate && $hseID == $houseID){
	$sql2 = "UPDATE `Mortality` SET `number` = '$number', remark = '$remark' WHERE entry_ID = '$entry_ID'";
	if ($con->query($sql2) === TRUE) {
		$successfulUpdateMsg = "Entry Updated Successfuly";
		echo "<script type='text/javascript'>alert('$successfulUpdateMsg');</script>";
		//header('Location: mortality.html');
	} else {
		echo "Error: " . $sql2 . "<br>" . $con->error;
	}
}else{

	$sql3 = "INSERT INTO Mortality(date, number, hse_ID, remark) VALUES ('$date', '$number', '$houseID', '$remark')";
	if ($con->query($sql3) === TRUE) {
		$successfulSaveMsg = "Entry Saved Successfuly";
		echo "<script type='text/javascript'>alert('$successfulSaveMsg');</script>";
	} else {
		echo "Error: " . $sql3 . "<br>" . $con->error;
	}
}

// UPDATE R
// SET R.status = '0'
// FROM dbo.ProductReviews AS R
// INNER JOIN dbo.products AS P
//        ON R.pid = P.id
// WHERE R.id = '17190'
//   AND P.shopkeeper = '89137';

$sql0 = "SELECT SUM(number) as totalmortalityforhouse From Mortality where Mortality.hse_ID = '$houseID'";
$result = $con->query($sql0);
$row = $result->fetch_assoc();
$totalMortality = $row['totalmortalityforhouse'];
//update broods current size
$sqlUpdateliveBirds = "UPDATE Brood SET Brood.CurrentSize = (Brood.InitialSize - $totalMortality) WHERE Brood.HouseAssigned = $houseID";
$con->query($sqlUpdateliveBirds);
?>
