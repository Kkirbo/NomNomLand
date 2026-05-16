<?php
require_once "../../private/php/utilities/data.php";
$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

$orderInfo = null;
if ($type === 'order') {
    $orderInfo = get_order_by_id($id);
} elseif ($type === 'user') {
    $orderInfo = get_user_last_order($id);
}

header('Content-Type: application/json');
if ($orderInfo) {
    echo json_encode(['status' => 200, 'data' => $orderInfo]);
    exit;
}
echo json_encode(['status' => 404]);
?>