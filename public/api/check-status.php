<?php
require_once '../../private/php/session.php';
header('Content-Type: application/json');

if (!is_logged_in()) {
    echo json_encode(["status" => "Free"]);
    exit;
}

$user = get_user_by_session();

if ($user["status"] === "blocked" || $user["status"] === "deactivated") {
    echo json_encode(["status" => $user["status"],"redirect" => "../views/logout.php"]);
    exit;
}

echo json_encode([
    "status" => $user["status"]
]);