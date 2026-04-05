<?php

require "./data_loader.php";

$orderId = $_POST["orderId"];
$orders = getOrders();

echo $orderId;

if ($_POST['action'] === 'complete') {
    $newStatus = "success";
} else if ($_POST['action'] === 'giveup') {
    $newStatus = "failed";
}

foreach($orders as &$order){
    if ($order["id"] == $orderId) {
        $order["delivery"]["status"] = $newStatus;
        break;
    }
}

unset($order);

file_put_contents("../../private/data/orders.json", json_encode($orders, JSON_PRETTY_PRINT));

header("Location: ../../public/views/delivery.php");
exit();

?>