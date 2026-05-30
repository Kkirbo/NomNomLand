<?php
require_once "../../private/php/session.php";
require_once "../../private/php/utilities/data.php";

header('Content-Type: application/json');

if (!is_logged_in()) {
    echo json_encode([ 'status' => 401, 'error' => 'Unauthorized' ]);
    exit;
}

$loggedInUser = get_user_by_session();
$orderId = $_GET['orderId'] ?? '';
$field = $_GET['field'] ?? '';
$value = $_GET['value'] ?? '';

if ($field === "rating") {
    $value = json_decode($value, true);
    if ($value === null || !is_array($value)) {
        echo json_encode([ 'status' => 400, 'error' => 'Invalid rating payload' ]);
        exit;
    }
}

if ($field === '' || $value === '' || $value === null) {
    echo json_encode([ 'status' => 400, 'error' => 'Missing data' ]);
    exit;
}

$order = get_order_by_id($orderId);
if (!$order) {
    echo json_encode([ 'status' => 404, 'error' => 'Order not found' ]);
    exit;
}

$allowed = false;

if ($field === 'rating') {
    if ($order['user_id'] !== $loggedInUser['id']) {
        echo json_encode([ 'status' => 403, 'error' => 'Only the order owner can rate this order' ]);
        exit;
    }
    if (isset($order['rating'])) {
        echo json_encode([ 'status' => 403, 'error' => 'Rating already submitted' ]);
        exit;
    }
    foreach ($value as $score) {
        if ($score === null) {
            continue;
        }
        if (!is_int($score) || $score < 1 || $score > 5) {
            echo json_encode([ 'status' => 400, 'error' => 'Each rating must be a number between 1 and 5' ]);
            exit;
        }
    }
    $allowed = true;
} elseif ($field === 'delivery->status') {
    $validStatuses = ['pending', 'preparing', 'ready', 'delivery', 'success', 'failed'];
    if (!in_array($value, $validStatuses, true)) {
        echo json_encode([ 'status' => 400, 'error' => 'Invalid delivery status' ]);
        exit;
    }
    if ($loggedInUser['role'] === 'admin' || $loggedInUser['role'] === 'cook') {
        $allowed = true;
    } elseif ($loggedInUser['role'] === 'delivery' && isset($order['delivery']['delivery_person_id']) && $order['delivery']['delivery_person_id'] === $loggedInUser['id']) {
        $allowed = true;
    } else {
        echo json_encode([ 'status' => 403, 'error' => 'Not allowed to change delivery status' ]);
        exit;
    }
} elseif ($field === 'delivery->delivery_person_id') {
    if ($loggedInUser['role'] !== 'admin') {
        echo json_encode([ 'status' => 403, 'error' => 'Only admin may assign delivery personnel' ]);
        exit;
    }
    $deliveryUser = get_user_by_id($value);
    if (!$deliveryUser || $deliveryUser['role'] !== 'delivery') {
        echo json_encode([ 'status' => 400, 'error' => 'Invalid delivery person' ]);
        exit;
    }
    $allowed = true;
} else {
    echo json_encode([ 'status' => 403, 'error' => 'Field not permitted to update' ]);
    exit;
}

if (!$allowed) {
    echo json_encode([ 'status' => 403, 'error' => 'Update not permitted' ]);
    exit;
}

$updated = update_order_field($orderId, $field, $value);
if ($updated) {
    echo json_encode([ 'status' => 200, 'success' => true ]);
    exit;
}

echo json_encode([ 'status' => 500, 'error' => 'Update failed' ]);
exit;
?>
