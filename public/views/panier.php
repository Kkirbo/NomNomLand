<?php
session_start();
require __DIR__ . '/../../private/php/session.php';
require_login();
$user = get_user_by_session();
$dataPath = realpath(__DIR__ . '/../../private/data');
$commandsFile = $dataPath . '/commands.json';
date_default_timezone_set('Europe/Paris');
$cartData = file_exists($commandsFile) ? json_decode(file_get_contents($commandsFile), true) : [
    "items" => [],
    "soloItems" => []
];

if (isset($_POST['dish_id'])) {
    $dishId = $_POST['dish_id'];

    $item = [
        "id" => $dishId,
        "user" => $user['username'] ?? 'unknown',
        "quantity" => 1,
        "timestamp" => date('Y-m-d H:i:s')
    ];
    if (empty($_POST['group'])) {
        $cartData['soloItems'][] = $item;
    } else {
        $cartData['items'][] = [$item]; 
    }
    file_put_contents($commandsFile, json_encode($cartData, JSON_PRETTY_PRINT));
}
header('Location: menu.php');
exit();