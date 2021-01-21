<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$promoId = $_POST['promoId'];

if($promoId) { 

 $sql = "UPDATE promotions SET promo_status = 2 WHERE promotion_id = {$promoId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the package";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST