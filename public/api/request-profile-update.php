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
$userId = urldecode($userId);
$field = $_GET['field'] ?? '';
$field = urldecode($field);
$value = $_GET['value'] ?? '';
$value = urldecode($value);

$targetUser = get_user_by_id($userId);
if (!$targetUser) {
    echo json_encode([ 'status' => 404, 'error' => 'User not found' ]);
    exit;
}

if ($field === "cookies") {
    $value = json_decode($value, true);
    if ($value === null || !is_array($value)) {
        echo json_encode([ 'status' => 400, 'error' => 'Invalid cookies payload.']);
        exit;
    }
}

if ($field === '' || $value === '' || $value === null) {
    echo json_encode([ 'status' => 400, 'error' => 'Missing data' ]);
    exit;
}

if (stripos($field, 'password') !== false) {
    echo json_encode([ 'status' => 403, 'error' => 'Password cannot be updated here' ]);
    exit;
}

$selfFields = [
    'profile->firstName',
    'profile->lastName',
    'profile->username',
    'profile->address',
    'profile->age',
    'profile->gender',
    'email',
    'phone',
    'cookies'
];
$adminFields = [
    'role',
    'status',
    'fidelity'
];
$allowedFields = $selfFields;
if ($loggedInUser['role'] === 'admin') {
    $allowedFields = array_merge($allowedFields, $adminFields);
}

if (!in_array($field, $allowedFields, true)) {
    echo json_encode([ 'status' => 403, 'error' => 'Field not editable' ]);
    exit;
}

if ($loggedInUser['id'] !== $userId && $loggedInUser['role'] !== 'admin') {
    echo json_encode([ 'status' => 403, 'error' => 'Not allowed to edit another user' ]);
    exit;
}

if ($field === 'email') {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([ 'status' => 400, 'error' => 'Invalid email format' ]);
        exit;
    }
    $existingUser = get_user_by_email($value);
    if ($existingUser && $existingUser['id'] !== $userId) {
        echo json_encode([ 'status' => 409, 'error' => 'Email already in use' ]);
        exit;
    }
}

if ($field === 'phone') {
    if (!preg_match('/^\+?[0-9]{10,15}$/', $value)) {
        echo json_encode([ 'status' => 400, 'error' => 'Invalid phone number format' ]);
        exit;
    }
}

if (strpos($field, 'profile->') === 0) {
    $profileField = substr($field, strlen('profile->'));
    switch ($profileField) {
        case 'firstName':
        case 'lastName':
        case 'username':
        case 'address':
            $value = trim($value);
            if ($value === '') {
                echo json_encode([ 'status' => 400, 'error' => 'Value must not be empty' ]);
                exit;
            }
            break;
        case 'age':
            if (!is_numeric($value) || (int)$value < 18 || (int)$value > 120) {
                echo json_encode([ 'status' => 400, 'error' => 'Age must be between 18 and 120' ]);
                exit;
            }
            $value = (int)$value;
            break;
        case 'gender':
            $value = strtolower(trim($value));
            if (!in_array($value, ['male', 'female', 'other'], true)) {
                echo json_encode([ 'status' => 400, 'error' => 'Invalid gender' ]);
                exit;
            }
            break;
        default:
            echo json_encode([ 'status' => 403, 'error' => 'Profile field not editable' ]);
            exit;
    }
}

if ($field === 'role') {
    if ($loggedInUser['role'] !== 'admin') {
        echo json_encode([ 'status' => 403, 'error' => 'Only admin can change roles' ]);
        exit;
    }
    if (!in_array($value, ['client', 'delivery', 'cook'], true)) {
        echo json_encode([ 'status' => 400, 'error' => 'Invalid role' ]);
        exit;
    }
}

if ($field === 'status') {
    if ($loggedInUser['role'] !== 'admin') {
        echo json_encode([ 'status' => 403, 'error' => 'Only admin can change status' ]);
        exit;
    }
    if (!in_array($value, ['free', 'premium', 'vip', 'blocked', 'deactivated'], true)) {
        echo json_encode([ 'status' => 400, 'error' => 'Invalid status' ]);
        exit;
    }
}

if ($field === 'fidelity') {
    if ($loggedInUser['role'] !== 'admin') {
        echo json_encode([ 'status' => 403, 'error' => 'Only admin can change fidelity' ]);
        exit;
    }
    if (!is_numeric($value) || (int)$value < 0) {
        echo json_encode([ 'status' => 400, 'error' => 'Invalid fidelity value' ]);
        exit;
    }
    $value = (int)$value;
}

if ($field === 'cookies' && $loggedInUser['id'] !== $userId) {
    echo json_encode([ 'status' => 403, 'error' => 'Only the owner may update cookies' ]);
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