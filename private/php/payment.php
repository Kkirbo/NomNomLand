<?php
function get_user_last_order($user) {
    if (!$user || !isset($user['email'])) return null;

    $email = $user['email'];
    $path = __DIR__ . "/../data/orders.json";

    if (!file_exists($path)) return;
    $content = file_get_contents($path);
    $data = json_decode($content, true);

    $userOrders = array_filter($data, function ($order) use ($email) {
        return isset($order['email']) && $order['email'] === $email;
    });
    usort($userOrders, function ($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });

    return $userOrders[0] ?? null;
}
function user_last_order_unpaid($user) {
    $latestOrder = get_user_last_order($user);
    return $latestOrder && $latestOrder['paymentStatus'] === 'pending';
}
?>