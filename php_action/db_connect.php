<?php 	

//Get Heroku ClearDB connection information
$cleardb_url      = parse_url(getenv("mysql://bb973c663f0808:5ac62113@us-cdbr-east-03.cleardb.com/heroku_bbe94552e006391?reconnect=true"));
$cleardb_server   = $cleardb_url["us-cdbr-east-03.cleardb.com"];
$cleardb_username = $cleardb_url["bb973c663f0808"];
$cleardb_password = $cleardb_url["5ac62113"];
$cleardb_db       = substr($cleardb_url["heroku_bbe94552e006391"],1);

$active_group = 'default';
$query_builder = TRUE;

// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$store_url = "http://localhost/php-inventory-management-system/";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>