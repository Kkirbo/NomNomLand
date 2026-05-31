<?php
require_once "../../private/php/session.php";
require_once "../../private/php/utilities/data.php";

header('Content-Type: application/json');
date_default_timezone_set('Pacific/Palau');

if (!is_logged_in()) {
    echo json_encode([ 'status' => 401, 'error' => 'Unauthorized' ]);
    exit;
}

$loggedInUser = get_user_by_session();

if (!$loggedInUser) {
    echo json_encode([ 'status' => 404, 'error' => 'User not found' ]);
    exit;
}

$options = json_decode($_GET['options'] ?? '{}', true);
$deliveryMode = $_GET['deliveryMode'] ?? '';
$deliveryMode = urldecode($deliveryMode);
$address = $loggedInUser['profile']['address'] ?? '';
if ($deliveryMode != "delivery") $address = "restaurant";

$cartInfo = get_user_cart($loggedInUser['id']);

if (!is_array($cartInfo)) {
    $cartInfo = [];
}

if (empty($cartInfo['contents'])) {
    echo json_encode([ 'status' => 400, 'error' => 'Cart is empty.' ]);
    exit;
}

$tip = isset($options['tip']) ? (float)$options['tip'] : 0;
$fidelityDiscount = $loggedInUser['fidelity']/1000;
$totalPrice = floor(1000 * $cartInfo['total'] * (1 + $tip / 100))/1000;
$updatedFidelity = update_user_field($loggedInUser['id'], 'fidelity', floor($totalPrice*100));
if ($updatedFidelity) $cartInfo['total'] = $cartInfo['total'] - $fidelityDiscount;

$order = [
    'id' => uniqid(),
    'user_id' => $loggedInUser['id'],
    'phone' => $loggedInUser['phone'] ?? '',
    'contents' => $cartInfo['contents'],
    'options' => $options,
    'delivery' => [
        'status' => 'pending',
        'address' => $address,
        'delivery_person_id' => ''
    ],
    'price' => $totalPrice,
    'paymentStatus' => 'pending',
    'date' => date('Y-m-d H:i:s')
];

$newOrder = create_order($order);
if (!$newOrder) {
    echo json_encode([ 'status' => 500, 'error' => 'Couldn\'t create a new order.' ]);
    exit;
}

$updated = update_user_field($loggedInUser['id'], 'cart', json_encode([]));
if (!$updated) {
    echo json_encode([ 'status' => 500, 'error' => 'Couldn\'t empty cart.' ]);
    exit;
}

echo json_encode([ 'status' => 200, 'data' => $order ]);
exit;
?>