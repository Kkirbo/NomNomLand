<?php

function loadJson($path) {
    return json_decode(file_get_contents($path), true);
}

function getDeliveryPeople() {
    return loadJson(__DIR__ . "/../data/delivery_people.json");
}

function getOrders() {
    return loadJson(__DIR__ . "/../data/orders.json");
}

?>