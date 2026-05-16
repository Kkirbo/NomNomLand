<?php
require __DIR__ . '/../../private/php/session.php';
require_login();

$user = get_user_by_session();

require_once "../../private/php/utilities/data.php";
require_once "../../private/php/cart.php";

date_default_timezone_set('Pacific/Palau');

$cartData = get_cart();

if (!isset($cartData['soloItems'])) {
    $cartData['soloItems'] = [];
}

if (!isset($cartData['items'])) {
    $cartData['items'] = [];
}

/**
 * AJOUT D'UN PLAT
 */
if (isset($_POST['dish_id'])) {

    $item = [
        "type" => "dish",
        "id" => $_POST['dish_id'],
        "user_id" => $user['id'],
        "quantity" => 1,
        "timestamp" => date('Y-m-d H:i:s'),
        "status" => "pending"
    ];

    $cartData['soloItems'][] = $item;
}

/**
 * AJOUT D'UN MENU
 */
if (isset($_POST['menu_id'])) {

    $item = [
        "type" => "menu",
        "id" => $_POST['menu_id'],
        "dishes" => $_POST['dishes'] ?? null,
        "desserts" => $_POST['desserts'] ?? null,
        "drinks" => $_POST['drinks'] ?? null,
        "user_id" => $user['id'],
        "quantity" => 1,
        "timestamp" => date('Y-m-d H:i:s'),
        "status" => "pending"
    ];

    $cartData['items'][] = $item;
}

save_cart($cartData);

header('Location: cart.php');
exit();
?>