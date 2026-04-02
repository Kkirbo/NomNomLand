<?php

function getDeliveryName($id, $people) {
    foreach ($people as $p) {
        if ($p['id'] === $id) return $p['name'];
    }
    return "Nobody";
}

?>