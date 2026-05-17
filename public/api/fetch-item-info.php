<?php
require_once "../../private/php/utilities/data.php";
$id = $_GET['id'] ?? '';

$itemInfo = get_dish_by_id($id);
if (!$itemInfo) {
    $itemInfo = get_menu_by_id($id);
}

header('Content-Type: application/json');
if ($itemInfo) {
    echo json_encode(['status' => 200, 'data' => $itemInfo]);
    exit;
}
echo json_encode(['status' => 404]);
?>