<?php
require_once '../../private/php/session.php';
require_once '../../private/php/utilities/data.php';

require_login();
$user = get_user_by_session();

function count_dishes($contents) {
    $counted = [];
    foreach ($contents as $dish) {
        $counted[$dish] = ($counted[$dish] ?? 0) + 1;
    }
    return $counted;
}

$lastOrder = get_user_last_order($user["id"]);

if (!$lastOrder || empty($lastOrder["content"])) {
    echo json_encode([
        "success" => true,
        "dishes" => []
    ]);
    exit;
}

$counted = count_dishes($lastOrder["content"]);

$enriched = [];

foreach ($counted as $dishId => $qty) {

    $dish = get_dish_by_id($dishId);

    if (!$dish) continue;

    $enriched[] = [
        "id" => $dish["id"],
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
exit;