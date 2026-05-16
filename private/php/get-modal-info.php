<?php
require_once __DIR__ . "/utilities/data.php";

function getModalInfo($type, $id) {
    if ($type === 'menu') {
        return get_menu_by_id($id);
    } elseif ($type === 'dish') {
        return get_dish_by_id($id);
    }
    return null;
}
?>