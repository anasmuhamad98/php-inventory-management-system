<?php 	

$localhost = "us-cdbr-east-03.cleardb.com";
$username = "bb973c663f0808";
$password = "5ac62113";
$dbname = "heroku_bbe94552e006391";
$store_url = "mysql://bb973c663f0808:5ac62113@us-cdbr-east-03.cleardb.com/heroku_bbe94552e006391?reconnect=true";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}
?>