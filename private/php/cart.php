<?php

function get_cart() {
    return load_data("commands.json", "commands");
}

function save_cart($cartData) {
    return save_data("commands.json", $cartData);
}

function get_user_cart_items($userId) {

    $cart = get_cart();

    $soloItems = array_filter(
        $cart['soloItems'] ?? [],
        fn($item) => ($item['user_id'] ?? null) === $userId
    );

    $menuItems = array_filter(
        $cart['items'] ?? [],
        fn($item) => ($item['user_id'] ?? null) === $userId
    );

    return [
        'soloItems' => array_values($soloItems),
        'items' => array_values($menuItems)
    ];
}

function remove_cart_item($userId, $id, $type = 'solo') {

    $cart = get_cart();

    $key = $type === 'solo' ? 'soloItems' : 'items';

    $cart[$key] = array_filter(
        $cart[$key] ?? [],
        fn($item) => !(
            ($item['user_id'] ?? null) === $userId &&
            $item['id'] === $id
        )
    );

    return save_cart($cart);
}

function clear_user_cart($userId) {

    $cart = get_cart();

    $cart['soloItems'] = array_filter(
        $cart['soloItems'] ?? [],
        fn($item) => ($item['user_id'] ?? null) !== $userId
    );

    $cart['items'] = array_filter(
        $cart['items'] ?? [],
        fn($item) => ($item['user_id'] ?? null) !== $userId
    );

    return save_cart($cart);
}

function add_order($order) {
    return add_data_entry($order, "orders.json", "orders");
}
?>