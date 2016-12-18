<?php
//create server and database connection constants
header('Content-Type: application/json');
$server = "localhost";
$user = "root";
$password = "48285";
$database = "BroilerFarmManagementSystem";

$con= new mysqli ($server,$user,$password, $database);

//Check server connection
if ($con->connect_error){
  die ("Failed to establish DB connection:". $con->connect_error);
}else{

  $query = ("SELECT CONCAT(CONCAT(DAY(date),'/'),Month(date)) as day, amount FROM FeedConsumption ORDER BY date");
  $result = $con->query($query);
  $data = array();
  foreach ($result as $row){
    $data[] = $row;
  }

  //free memory associated with result

//close connection

  print json_encode($data);

}
?>
