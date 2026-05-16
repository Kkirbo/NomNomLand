<?php
require_once "../../private/php/utilities/data.php";
$orderId = $_GET['orderId'] ?? '';
$field = $_GET['field'] ?? '';
$value = $_GET['value'] ?? '';

$updated = update_order_field($orderId, $field, $value);

header('Content-Type: application/json');
if ($updated) echo json_encode([ 'status' => 200 ]);
else echo json_encode([ 'status' => 400 ]);
exit;
?>