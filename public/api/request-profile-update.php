<?php
require_once "../../private/php/utilities/data.php";
$userId = $_GET['userId'] ?? '';
$field = $_GET['field'] ?? '';
$value = $_GET['value'] ?? '';

if ($field === "cookies") {
    $value = json_decode($value, true);
}

$unauthorized = false;
$updated = false;
if (!$value || $value == "") $unauthorized = true;
else if (!$unauthorized) $updated = update_user_field($userId, $field, $value);

header('Content-Type: application/json');
if ($updated) echo json_encode([ 'status' => 200 ]);
else if ($unauthorized) echo json_encode([ 'status' => 401 ]);
else echo json_encode([ 'status' => 404 ]);
exit;
?>