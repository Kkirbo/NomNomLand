<?php
require_once "../../private/php/utilities/data.php";
$orderId = $_GET['orderId'] ?? '';
$field = $_GET['field'] ?? '';
$value = $_GET['value'] ?? '';

$unauthorized = false;
$updated = false;
if (!$value || $value == "") $unauthorized = true;
else if (!$unauthorized) $updated = update_order_field($orderId, $field, $value);

header('Content-Type: application/json');
if ($updated) echo json_encode([ 'status' => 200 ]);
else if ($unauthorized) echo json_encode([ 'status' => 401 ]);
else echo json_encode([ 'status' => 404 ]);
exit;
?>