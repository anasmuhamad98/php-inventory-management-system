<?php

require_once 'core.php';

$sql = "SELECT * FROM promotions WHERE promo_status = 1";
$result = $connect->query($sql);
$output = array('data' => array());

if ($result->num_rows > 0) {

	// $row = $result->fetch_array();
	$statusPromo = "";
	$x = 1;

	while ($row = $result->fetch_array()) {
		$promoId = $row[0];
		//to get promo_items
		$promoItem = "";
		$promoItemoutput = array();
		$promoItemsql = "SELECT * FROM promotion_item WHERE promo_item_status = 1";
		$promoresult = $connect->query($promoItemsql);

		if ($promoresult->num_rows > 0) {

			$totalProduct = 0;
			while ($row2 = $promoresult->fetch_array()) {

				if ($row2[1] == $promoId) {

					$productsql = "SELECT * FROM product WHERE product_id = $row2[2]";
					$productresult = $connect->query($productsql);
					$row3 = $productresult->fetch_array();
					$items = $row3[1];

					// array_push($promoItemoutput, $items);

					$promoItemoutput[] = array(
						" {$items}"
					);
					$totalProduct++;
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
	    <button type="button" data-toggle="modal" data-target="#removePromoModal" onclick="removePromos(' . $promoId . ')"> <i class="glyphicon glyphicon-trash"></i> Remove</button>    
	</div>';

		$output['data'][] = array(
			$x,
			$row[1],
			$promoItemoutput,
			$totalProduct,
			$statusPromo,
			$button
		);
		$x++;
		// unset($promoItemoutput);
		// $promoItemoutput[] = array();
	} // /while 

} // if num_rows

$connect->close();
echo json_encode($output);
