<?php
require '../../private/php/session.php';
require '../../private/php/data_loader.php';

header('Content-Type: application/json');
require_login(); 

$loggedInUser = get_user_by_session();

$data = json_decode(file_get_contents("php://input"), true);

$field = $data['field'] ?? null;
$value = $data['value'] ?? null;

if (!$field || !$value) {
    echo json_encode(["success" => false, "error" => "Missing data"]);
    exit;
}

// whitelist des champs modifiables
$profileKeys = ["firstName", "lastName", "username", "address"];
$nonProfileKeys = ["phone", "email"];

$allowedFields = array_merge($profileKeys, $nonProfileKeys);

if (!in_array($field, $allowedFields)) {
    echo json_encode(["success" => false, "error" => "Invalid field"]);
    exit;
}


$path = "../../private/data/users.json";
$content = file_get_contents($path);
$users_data = json_decode($content, true);

if ($field == "email") {
    $_SESSION["user_email"] = $value;
}

if (in_array($field, $profileKeys)) {

    foreach($users_data["users"] as &$user) {
        if ($user["email"] == $loggedInUser["email"]) {
            $user["profile"][$field] = $value;
        }
    }

} else {

    foreach($users_data["users"] as &$user) {
        if ($user["email"] == $loggedInUser["email"]) {
            $user[$field] = $value;
        }
    }

}


$json = json_encode($users_data, JSON_PRETTY_PRINT);
file_put_contents($path, $json);


echo json_encode(["success" => true]);
?>