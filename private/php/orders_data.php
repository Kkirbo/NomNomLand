<?php

$json = file_get_contents("../../private/data/orders.json");
$orders = json_decode($json, true);

?>