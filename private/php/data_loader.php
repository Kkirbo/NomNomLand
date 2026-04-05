<?php

function loadJson($path) {
    return json_decode(file_get_contents($path), true);
}

function getUsers() {
    $users = loadJson(__DIR__ . "/../data/users.json");
    $users = $users["users"];
    return $users;
}

function getOrders() {
    return loadJson(__DIR__ . "/../data/orders.json");
}

function getDeliveryName($id) {
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) return $user['profile']['firstName'] . ' ' . $user['profile']['lastName'];
    }
    return "Nobody";
}

function getDeliveryPeople() {
    $users = getUsers();
    $deliveryPeople = array();
    foreach ($users as $user) {
        if ($user['role'] === 'delivery') {
            array_push($deliveryPeople, $user);
        }
    }

    return $deliveryPeople;
}

function getOrderByDeliveryId($delivery_id) {
    $orders = getOrders();
    foreach($orders as $order) {
        if ($order["delivery"]["delivery_person_id"] === $delivery_id && $order["delivery"]["status"] == "delivery") {
            return $order;
        }
    }

    return null;
}

?>