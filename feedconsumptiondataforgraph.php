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

  $query = ("SELECT CONCAT(CONCAT(hseName,' - '),CONCAT(CONCAT(DAY(date),'/'),Month(date))) as housetotalperdate, SUM(amount) as amount from FeedConsumption INNER JOIN Houses on FeedConsumption.hse_ID = Houses.hse_ID GROUP BY FeedConsumption.hse_ID , date ORDER BY date");
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
