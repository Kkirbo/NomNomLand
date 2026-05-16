<?php
require_once "../../private/php/utilities/data.php";

$orders = get_orders();

$orderId = $_POST['orderId'];
$newStatus = $_POST['status'];
$deliveryPersonId = $_POST['delivery_person_id'] ?? null;

update_order_field($orderId, "delivery->status", $newStatus);
if ($newStatus == "delivery" && $deliveryPersonId != null) {
    update_order_field($orderId, "delivery->delivery_person_id", $deliveryPersonId);
}

header("Location: ../../public/views/orders.php");
exit();
?>