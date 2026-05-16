<?php
require_once __DIR__ . "/utilities/data.php";

$orderId = $_POST["orderId"];

if ($_POST['action'] === 'complete') {
    $newStatus = "success";
} else if ($_POST['action'] === 'giveup') {
    $newStatus = "failed";
}

update_order_field($orderId, "delivery->status", $newStatus);

header("Location: ../../public/views/delivery.php");
exit();

?>