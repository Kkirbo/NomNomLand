<?php
require_once "../../private/php/session.php";
require_once "../../private/php/utilities/data.php";

header('Content-Type: application/json');

if (!is_logged_in()) {
    echo json_encode([ 'status' => 401, 'error' => 'Unauthorized' ]);
    exit;
}

$loggedInUser = get_user_by_session();
$userId = $_GET['userId'] ?? '';
$field = $_GET['field'] ?? '';
$value = $_GET['value'] ?? '';
$value = urldecode($value);

$targetUser = get_user_by_id($userId);
if (!$targetUser) {
    echo json_encode([ 'status' => 404, 'error' => 'User not found' ]);
    exit;
}


if ($field === '' || $value === '' || $value === null) {
    echo json_encode([ 'status' => 400, 'error' => 'Missing data' ]);
    exit;
}

$updated = update_user_field($userId, $field, $value);
if ($updated) {
    echo json_encode([ 'status' => 200, 'success' => true ]);
    exit;
}

echo json_encode([ 'status' => 500, 'error' => 'Update failed' ]);
exit;
?>