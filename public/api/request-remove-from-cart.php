<?php
require_once "../../private/php/session.php";
require_once "../../private/php/utilities/data.php";

header('Content-Type: application/json');

if (!is_logged_in()) {
    echo json_encode([ 'status' => 401, 'error' => 'Unauthorized' ]);
    exit;
}

$loggedInUser = get_user_by_session();
$item_id = $_GET['item_id'] ?? '';
$item_id = urldecode($item_id);
$quantity = $_GET['quantity'] ?? '';
$quantity = urldecode($quantity);

if (!$loggedInUser) {
    echo json_encode([ 'status' => 404, 'error' => 'User not found' ]);
    exit;
}

if ($item_id === '' || $item_id === null) {
    echo json_encode([ 'status' => 400, 'error' => 'Missing data' ]);
    exit;
}

$quantity = (int)($quantity ?? 1);
$quantity = max(1, min($quantity, 999));

$cart = json_decode($loggedInUser['cart'] ?? '[]', true);
if (!is_array($cart)) {
    $cart = [];
}

$item = [
    'id' => $item_id,
    'quantity' => $quantity
];

$starter = $_GET['starter'] ?? '';
$starter = urldecode($starter);
$main_course = $_GET['main_course'] ?? '';
$main_course = urldecode($main_course);
$drink = $_GET['drink'] ?? '';
$drink = urldecode($drink);
$dessert = $_GET['dessert'] ?? '';
$dessert = urldecode($dessert);

$contents = [];

if ($starter !== '') $contents[] = $starter;
if ($main_course !== '') $contents[] = $main_course;
if ($drink !== '') $contents[] = $drink;
if ($dessert !== '') $contents[] = $dessert;
if (!empty($contents)) $item['contents'] = $contents;

$deleted = false;
foreach ($cart as $index => &$existing) {
    $existingContents = $existing['contents'] ?? [];
    $itemContents = $item['contents'] ?? [];

    sort($existingContents);
    sort($itemContents);

    if (($existing['id'] ?? '') === $item['id'] && $existingContents == $itemContents) {
        $existing['quantity'] = ($existing['quantity'] ?? 0) - $item['quantity'];
        //We send the final quantity in response
        $item['quantity'] = $existing['quantity'];
        if ($existing['quantity'] <= 0) array_splice($cart, $index, 1);
        $deleted = true;
        break;
    }
}
unset($existing);

$updated = update_user_field($loggedInUser['id'], "cart", json_encode($cart));
if ($updated && $deleted) {
    echo json_encode([ 'status' => 200, 'data' => $item, 'success' => 'Item removed from cart']);
    exit;
}

echo json_encode([ 'status' => 500, 'error' => 'Failed to remove item from cart']);
exit;
?>