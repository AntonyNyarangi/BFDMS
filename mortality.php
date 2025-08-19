<?php
// DB connection constants
$server   = "localhost:3306";
$user     = "root";
$password = "abcd1234";
$database = "PoultryFarmManagementSystem";

$con = new mysqli($server, $user, $password, $database);

// Check server connection
if ($con->connect_error) {
    die("Failed to establish DB connection: " . $con->connect_error);
}

// Receive values from user form and trim white spaces
$date    = trim($_POST['date']);
$number  = trim($_POST['number']);
$houseID = trim($_POST['house']);   // should be hse_ID, not house name
$remark  = trim($_POST['remark']);

// --- Step 1: Check if mortality record exists for this house & date ---
$sql1 = "SELECT entry_ID, date, hse_ID FROM Mortality WHERE date = ? AND hse_ID = ?";
$stmt1 = $con->prepare($sql1);
$stmt1->bind_param("si", $date, $houseID);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1 && $result1->num_rows > 0) {
    // Record exists → update
    $row      = $result1->fetch_assoc();
    $entry_ID = $row['entry_ID'];

    $sql2 = "UPDATE Mortality SET number = ?, remark = ? WHERE entry_ID = ?";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param("isi", $number, $remark, $entry_ID);

    if ($stmt2->execute()) {
        echo "<script>alert('Entry Updated Successfully');</script>";
    } else {
        echo "Error updating: " . $con->error;
    }
    $stmt2->close();
} else {
    // No record → insert
    $sql3 = "INSERT INTO Mortality(date, number, hse_ID, remark) VALUES (?, ?, ?, ?)";
    $stmt3 = $con->prepare($sql3);
    $stmt3->bind_param("siis", $date, $number, $houseID, $remark);

    if ($stmt3->execute()) {
        echo "<script>alert('Entry Saved Successfully');</script>";
    } else {
        echo "Error inserting: " . $con->error;
    }
    $stmt3->close();
}
$stmt1->close();

// --- Step 2: Update Brood CurrentSize based on total mortality ---
$sql0 = "SELECT SUM(number) as totalmortalityforhouse FROM Mortality WHERE hse_ID = ?";
$stmt0 = $con->prepare($sql0);
$stmt0->bind_param("i", $houseID);
$stmt0->execute();
$result0 = $stmt0->get_result();
$row0 = $result0->fetch_assoc();
$totalMortality = $row0['totalmortalityforhouse'] ?? 0;
$stmt0->close();

$sqlUpdate = "UPDATE Brood SET CurrentSize = (InitialSize - ?) WHERE HouseAssigned = ?";
$stmtU = $con->prepare($sqlUpdate);
$stmtU->bind_param("ii", $totalMortality, $houseID);
$stmtU->execute();
$stmtU->close();

$con->close();
?>
