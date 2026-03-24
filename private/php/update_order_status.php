<?php

$json = file_get_contents("../../private/data/orders.json");
$orders = json_decode($json, true);

$orderId = $_POST['order_id'];
$newStatus = $_POST['status'];

foreach($orders as &$order){
    if ($order["id"] == $orderId) {
        $order["delivery"]["status"] = $newStatus;
        break;
    }
}

unset($order);

file_put_contents("../../private/data/orders.json", json_encode($orders, JSON_PRETTY_PRINT));

header("Location: ../../public/views/orders.php");
exit();

?>