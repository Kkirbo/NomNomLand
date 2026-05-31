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

$cartInfo = get_user_cart($loggedInUser['id']);

if ($cartInfo) {
    echo json_encode([ 'status' => 200, 'data' => $cartInfo ]);
    exit;
}

echo json_encode([ 'status' => 500, 'error' => 'Failed to fetch.' ]);
exit;
?>