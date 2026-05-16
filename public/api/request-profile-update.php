<?php
require_once "../../private/php/utilities/data.php";
$userId = $_GET['userId'] ?? '';
$field = $_GET['field'] ?? '';
$value = $_GET['value'] ?? '';

$updated = update_user_field($userId, $field, $value);

header('Content-Type: application/json');
if ($updated) echo json_encode([ 'success' => true ]);
else echo json_encode([ 'success' => false ]);
exit;
?>