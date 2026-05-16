<?php
require_once "../../private/php/utilities/data.php";
$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

$modalInfo = null;
if ($type === 'menu') {
    $modalInfo = get_menu_by_id($id);
} elseif ($type === 'dish') {
    $modalInfo = get_dish_by_id($id);
}

header('Content-Type: application/json');
if ($modalInfo) {
    echo json_encode(['status' => 200, 'data' => $modalInfo]);
    exit;
}
echo json_encode(['status' => 404]);
?>