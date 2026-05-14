<?php
require __DIR__ . '/../../private/php/session.php';

require_login();

$user = get_user_by_session();

$userlastdish = get_user_lastdish($user["email"]);

if ($userlastdish === null) {
    $countedDishes = [];
} else {
    $countedDishes = count_dishes($userlastdish);
}

$dishesCatalog = get_dishes();
$dishMap = [];

foreach ($dishesCatalog as $dish) {
    $dishMap[$dish["title"]] = $dish;
}

$enriched = [];

foreach ($countedDishes as $title => $qty) {

    if (!isset($dishMap[$title])) continue;

    $d = $dishMap[$title];

    $enriched[] = [
        "title" => $title,
        "quantity" => $qty,
        "image" => $d["image"],
        "version" => $d["version"],
        "price" => $d["price"]
    ];
}

header('Content-Type: application/json');

echo json_encode([
    "success" => true,
    "dishes" => $enriched
]);