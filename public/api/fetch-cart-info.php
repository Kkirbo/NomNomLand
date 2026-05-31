<?php
require_once "../../private/php/session.php";
require_once "../../private/php/utilities/data.php";

header('Content-Type: application/json');

if (!is_logged_in()) {
    echo json_encode([ 'status' => 401, 'error' => 'Unauthorized' ]);
    exit;
}

$loggedInUser = get_user_by_session();

if (!$loggedInUser) {
    echo json_encode([ 'status' => 404, 'error' => 'User not found' ]);
    exit;
}

$cart = json_decode($loggedInUser['cart'] ?? '[]', true);
if (!is_array($cart)) {
    $cart = [];
}

$cartInfo = [
    'items' => $cart,
    'total' => 0
];

foreach ($cart as $item) {
    $itemInfo = get_dish_by_id($item['id']);
    if (!$itemInfo) {
        $itemInfo = get_menu_by_id($item['id']);
    }
    $price = $itemInfo['price'] ?? 0;
    $cartInfo['total'] += $price * $item['quantity'];
}
$cartInfo['total'] = floor($cartInfo['total']*1000)/1000;

if ($cartInfo) {
    echo json_encode([ 'status' => 200, 'data' => $cartInfo ]);
    exit;
}

echo json_encode([ 'status' => 500, 'error' => 'Failed to fetch.' ]);
exit;
?>