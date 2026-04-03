<?php

function loadJson($path) {
    return json_decode(file_get_contents($path), true);
}

function getUsers() {
    $users = loadJson(__DIR__ . "/../data/users.json");
    return $users;
}

function getOrders() {
    return loadJson(__DIR__ . "/../data/orders.json");
}

function getDeliveryName($id, $users) {
    foreach ($users as $user) {
        if ($user['User']['id'] == $id) return $user['User']['profile']['firstName'] . ' ' . $user['User']['profile']['lastName'];
    }
    return "Nobody";
}

?>