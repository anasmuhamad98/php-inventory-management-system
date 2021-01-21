<?php

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array(), 'promotion_id' => '');

if ($_POST) {

    $budgetPromotion = $_POST['budgetPromotion'];
    $sortPromotion = $_POST['sortPromotion'];

    $sql = "INSERT INTO promotions (total_value, promo_status, user_id) VALUES ('$budgetPromotion', 1, 1)";

    $orderStatus = false;
    if ($connect->query($sql) === TRUE) {
        $promotion_id = $connect->insert_id;
        $valid['promotion_id'] = $promotion_id;

        $orderStatus = true;
    }

    $totalProduct = 1;
    $productsql = "SELECT * FROM product WHERE product.status = 1 AND product.quantity>0";
    $productresult = $connect->query($productsql);
    while ($product = $productresult->fetch_array()) {
        $totalProduct++;
    }
    
    $x = 1;
    while ($x <= $budgetPromotion) {
        $randNumber = (rand(1, $totalProduct));
        $pricesql = "SELECT * FROM product WHERE product.product_id = $randNumber";
        $priceresult = $connect->query($pricesql);
        $priceProduct = $priceresult->fetch_array();
        $itemsql = "INSERT INTO promotion_item (promotion_id, product_id, quantity, rate, total, promo_item_status) VALUES ('$promotion_id', '$randNumber', 1, '$priceProduct[6]', '$budgetPromotion', 1)";
        if ($connect->query($itemsql) === TRUE) {
            $orderStatus = true;
        }
        $x= $x + $priceProduct[6];
    }



    $valid['success'] = true;
    $valid['messages'] = "Successfully Added";

    $connect->close();

    echo json_encode($valid);
} // /if $_POST