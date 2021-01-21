<?php 	

require_once 'core.php';

$promoId = $_POST['promoId'];

$sql = "SELECT * FROM promotions WHERE promotion_id = $promoId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);