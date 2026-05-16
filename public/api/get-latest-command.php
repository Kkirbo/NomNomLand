<?php
require __DIR__ . '/../../private/php/session.php';

require_login();

$user = get_user_by_session();

$lastOrder = get_user_last_order($user["id"]);

if ($lastOrder === null) {
    $countedDishes = [];
} else {
    $countedDishes = count_dishes($lastOrder["dishes"]);
}
$enriched = [];

foreach ($countedDishes as $dishId => $qty) {

    $dish = get_dish_by_id($dishId);

    if (!$dish) continue;

    $enriched[] = [
        "title" => $dish["title"],
        "quantity" => $qty,
        "image" => $dish["image"],
        "version" => $dish["version"],
        "price" => $dish["price"]
    ];
}
header('Content-Type: application/json');

echo json_encode([
    "success" => true,
    "dishes" => $enriched
]);