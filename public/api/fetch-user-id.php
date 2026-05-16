<?php
require_once "../../private/php/session.php";
$user = get_user_by_session();
$id = null;
if ($user) {
    $id = $user['id'];
}

header('Content-Type: application/json');
if ($id) {
    echo json_encode(['status' => 200, 'id' => $id]);
    exit;
}
echo json_encode(['status' => 404]);
?>