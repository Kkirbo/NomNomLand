<?php
session_start();
require __DIR__ . '/../../private/php/session.php';
require_login();
$user = get_user_by_session();
$dataPath = realpath(__DIR__ . '/../../private/data');
$commandsFile = $dataPath . '/commands.json';
date_default_timezone_set('Europe/Paris');
if (file_exists($commandsFile)) {
    $cartData = json_decode(file_get_contents($commandsFile), true);
} else {
    $cartData = [
        "items" => [],
        "soloItems" => []
    ];
}
if (isset($user['email'])) {
    $username = $user['email'];
} else {
    $username = "unknown";
}

if (isset($_POST['dish_id'])) {
    $item = [
        "type" => "dish",
        "id" => $_POST['dish_id'],
        "user" => $username,
        "quantity" => 1,
        "timestamp" => date('Y-m-d H:i:s'),
        "status" => "commanded"
    ];
    $cartData['soloItems'][] = $item;
}
if (isset($_POST['menu_id'])) {
    if (isset($_POST['dishes'])) {
        $dishes = $_POST['dishes'];
    } else {
        $dishes = null;
    }
    if (isset($_POST['desserts'])) {
        $desserts = $_POST['desserts'];
    } else {
        $desserts = null;
    }
    if (isset($_POST['drinks'])) {
        $drinks = $_POST['drinks'];
    } else {
        $drinks = null;
    }
    $item = [
        "type" => "menu",
        "id" => $_POST['menu_id'],
        "dishes" => $dishes,
        "desserts" => $desserts,
        "drinks" => $drinks,
        "user" => $username,
        "quantity" => 1,
        "timestamp" => date('Y-m-d H:i:s'),
        "status" => "commanded"
    ];
    $cartData['items'][] = $item;
}
file_put_contents($commandsFile, json_encode($cartData, JSON_PRETTY_PRINT));
header('Location: menu.php');
exit();