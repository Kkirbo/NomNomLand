<?php

require_once "./data_loader.php";

$orders = getOrders();

$orderId = $_POST['order_id'];
$newStatus = $_POST['status'];
$deliveryPersonId = $_POST['delivery_person_id'] ?? null;

foreach($orders as &$order){
    if ($order["id"] == $orderId) {
        $order["delivery"]["status"] = $newStatus;

        if ($newStatus == "delivery" && $deliveryPersonId != null) {
            $order["delivery"]["delivery_person_id"] = $deliveryPersonId;
        }

        break;
    }
}

unset($order);

file_put_contents("../../private/data/orders.json", json_encode($orders, JSON_PRETTY_PRINT));

header("Location: ../../public/views/orders.php");
exit();

?>