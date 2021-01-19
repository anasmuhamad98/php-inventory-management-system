<?php

require_once 'core.php';

$sql = "SELECT * FROM promotions WHERE promo_status = 1";
$result = $connect->query($sql);
$output = array('data' => array());

$promoItemsql = "SELECT * FROM promotion_item WHERE promo_item_status = 1";
$promoresult = $connect->query($promoItemsql);
$promoItemoutput = array();




if ($result->num_rows > 0) {

	// $row = $result->fetch_array();
	$statusPromo = "";
	$x = 1;

	while ($row = $result->fetch_array()) {
		$promoId = $row[0];
		//to get promo_items
		$promoItem = "";

		if ($promoresult->num_rows > 0) {
		while ($row2 = $promoresult->fetch_array()) {
			$promoItemId = "";
			if ($row2[1] == $promoId) {
				$productsql = "SELECT * FROM product WHERE product_id = $row2[2]";
				$productresult = $connect->query($productsql);
				$row3 = $productresult->fetch_array();
				$items = $row3[1];
				$promoItemoutput[] = array(
					" {$items}",
				);
					}
			}
		}

		// active 
		if ($row[2] == 1) {
			// activate member
			$statusPromo = "<label class='label label-success'>Available</label>";
		} else {
			// deactivate member
			$statusPromo = "<label class='label label-danger'>Not Available</label>";
		}

		$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editPromotionModel" onclick="editBrands(' . $promoId . ')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands(' . $promoId . ')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

		$output['data'][] = array(
			$x,
			$row[1],
			$promoItemoutput,
			$statusPromo,
			$button
		);
		$x++;
	} // /while 

} // if num_rows

$connect->close();
echo json_encode($output);
