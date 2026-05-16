<?php
require __DIR__ . '/../../private/php/session.php';
require_login();
$user = get_user_by_session();

require_once "../../private/php/utilities/data.php";
require_once "../../private/php/cart.php";

date_default_timezone_set('Pacific/Palau');

$cartData = get_cart();

$username = $user['email'] ?? 'unknown';

if (isset($_POST['dish_id'])) {
    $item = [
        "type" => "dish",
        "id" => $_POST['dish_id'],
        "user" => $username,
        "quantity" => 1,
        "timestamp" => date('Y-m-d H:i:s'),
        "status" => "pending"
    ];
    $cartData['soloItems'][] = $item;
}
if (isset($_POST['menu_id'])) {
    $dishes = $_POST['dishes'] ?? null;
    $desserts = $_POST['desserts'] ?? null;
    $drinks = $_POST['drinks'] ?? null;

    $item = [
        "type" => "menu",
        "id" => $_POST['menu_id'],
        "dishes" => $dishes,
        "desserts" => $desserts,
        "drinks" => $drinks,
        "user_id" => $user['id'],
        "quantity" => 1,
        "timestamp" => date('Y-m-d H:i:s'),
        "status" => "commanded"
    ];
    $cartData['items'][] = $item;
}
save_cart($cartData);
header('Location: menu.php');
exit();