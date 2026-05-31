<?php
require '../utilities/data.php';
require '../session.php';
header("Content-Type: application/json");
$user = get_user_by_session();
if (!$user) {
    echo json_encode(["success" => false, "error" => "Not logged in"]);
    exit;
}
$password = $_POST["password"] ?? "";
$confirm  = $_POST["confirmPassword"] ?? "";
if ($password !== $confirm) {
    echo json_encode(["success" => false, "error" => "Passwords do not match"]);
    exit;
}
update_user_password($user["id"], $password);
$newCode = password_hash(generateResetCode(), PASSWORD_DEFAULT);
update_user_field($user["id"], "recoveryCode", $newCode);

logout();

echo json_encode(["success" => true]);