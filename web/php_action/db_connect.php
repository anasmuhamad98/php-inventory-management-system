<?php 	

$localhost = "us-cdbr-east-03.cleardb.com";
$username = "bb973c663f0808";
$password = "5ac62113";
$dbname = "heroku_bbe94552e006391";
$store_url = "https://inventory-management-sme.herokuapp.com/";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}
?>