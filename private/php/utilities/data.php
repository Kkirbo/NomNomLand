<?php
if (!defined("PATH_TO_DATA_FOLDER")) define("PATH_TO_DATA_FOLDER", __DIR__ . "/../../data/");

/**
 * JSON DATA
 */
function load_data($filename, $dataKey) {
    $path = PATH_TO_DATA_FOLDER . $filename;

    if (!file_exists($path)) return [$dataKey => []];

    $content = file_get_contents($path);
    if ($content === false) {
        echo "Failed to read $filename";
        $error = "Internal server error, please try again.";
        return [$dataKey => []];
    }

    $json = json_decode($content, true);
    if ($json === false || $json === null) {
        echo "JSON decode error for $filename: " . json_last_error_msg();
        $error = "Internal server error, please try again.";
        return [$dataKey => []];
    }

    if (!isset($json[$dataKey]) || !is_array($json[$dataKey])) {
        $json[$dataKey] = [];
    }

    return $json;
}
function save_data($filename, $data) {
    $path = PATH_TO_DATA_FOLDER . $filename;

    $json = json_encode($data, JSON_PRETTY_PRINT);
    if ($json === false) {
        echo "JSON encode error: " . json_last_error_msg();
        $error = "Internal server error, please try again.";
        return false;
    }

    $result = file_put_contents($path, $json);
    if ($result === false) {
        echo "Failed to write $filename";
        $error = "Internal server error, please try again.";
        return false;
    }

    return true;
}

function add_data_entry($entry, $file, $dataKey) {
    $data = load_data($file, $dataKey);
    $data[$dataKey][] = $entry;
    return save_data($file, $data);
}
function update_data_entry($entryId, $newData, $file, $dataKey) {
    $data = load_data($file, $dataKey);
    foreach ($data[$dataKey] as &$entry) {
        if ($entry['id'] === $entryId) {
            $entry = $newData;//array_merge($entry, $newData);
            return save_data($file, $data);
        }
    }
    return false;
}

/**
 * USERS
 */
function get_users() {
    $data = load_data("users.json", "users");
    return $data['users'];
}
function get_users_by_role($role) {
    $users = [];
    foreach (get_users() as $user) {
        if ($user["role"] === $role) {
            $users[] = $user;
        }
    }
    return $users;
}
function get_users_by_firstname($firstname) {
    $users = [];
    foreach (get_users() as $user) {
        if ($user["profile"]["firstname"] === $firstname) {
            $users[] = $user;
        }
    }
    return $users;
}
function get_user_by_email($email) {
    foreach (get_users() as $user) {
        if ($user["email"] === $email) {
            return $user;
        }
    }
    return null;
}
function get_user_by_id($id) {
    foreach (get_users() as $user) {
        if ($user["id"] === $id) {
            return $user;
        }
    }
    return null;
}

function get_user_full_name($id) {
    $user = get_user_by_id($id);
    if ($user) {
        return $user['profile']['firstName'] . ' ' . $user['profile']['lastName'];
    }
    return "None";
}

function register_user($user) {
    return add_data_entry($user, "users.json", "users");
}
function update_user($userId, $newData) {
    return update_data_entry($userId, $newData, "users.json", "users");
}
function update_user_field($userId, $fieldPath, $newValue) {
    $userData = get_user_by_id($userId);
    if (!$userData) return false;

    $fields = explode('->', $fieldPath);
    $currentField = &$userData;
    foreach ($fields as $field) {
        if (!isset($currentField[$field]) || !is_array($currentField[$field]) && $field !== end($fields)) {
            $currentField[$field] = [];
        }
        $currentField = &$currentField[$field];
    }
    $currentField = $newValue;

    return update_user($userId, $userData);
}

/**
 * ORDERS
 */
function get_orders() {
    $data = load_data("orders.json", "orders");
    return $data['orders'];
}
function get_order_by_id($id) {
    foreach (get_orders() as $order) {
        if ($order["id"] === $id) {
            return $order;
        }
    }
    return null;
}
function get_order_by_delivery_id($user_id) {
    foreach (get_orders() as $order) {
        if ($order["delivery"]["delivery_person_id"] === $user_id && $order["delivery"]["status"] == "delivery") {
            return $order;
        }
    }
    return null;
}
function get_orders_by_user_id($user_id) {
    $orders = [];
    foreach (get_orders() as $order) {
        if ($order["user_id"] === $user_id) {
            $orders[] = $order;
        }
    }
    return $orders;
}
function update_order($orderId, $newData) {
    return update_data_entry($orderId, $newData, "orders.json", "orders");
}
function update_order_field($orderId, $fieldPath, $newValue) {
    $orderData = get_order_by_id($orderId);
    if (!$orderData) return false;

    $fields = explode('->', $fieldPath);
    $currentField = &$orderData;
    foreach ($fields as $field) {
        if (!isset($currentField[$field]) || !is_array($currentField[$field]) && $field !== end($fields)) {
            $currentField[$field] = [];
        }
        $currentField = &$currentField[$field];
    }
    $currentField = $newValue;

    return update_order($orderId, $orderData);
}
function get_user_last_order($userId) {
    $userOrders = get_orders_by_user_id($userId);
    $lastOrder = null;
    foreach ($userOrders as $order) {
        if ($lastOrder === null || strtotime($order["date"]) > strtotime($lastOrder["date"])){
            $lastOrder = $order;
        }
    }
    if (!$lastOrder) return null;
    return $lastOrder;
}
function is_user_last_order_unpaid($userId) {
    $latestOrder = get_user_last_order($userId);
    return $latestOrder && $latestOrder['paymentStatus'] === 'pending';
}

/**
 * DISHES/MENUS
 */
function get_menus() {
    $data = load_data("menus.json", "menus");
    return $data['menus'];
}
function get_menu_by_id($id) {
    foreach (get_menus() as $menu) {
        if ($menu["id"] === $id) {
            return $menu;
        }
    }
    return null;
}
function get_dishes() {
    $data = load_data("dishes.json", "dishes");
    return $data['dishes'];
}
function get_dish_by_id($id) {
    foreach (get_dishes() as $dish) {
        if ($dish["id"] === $id) {
            return $dish;
        }
    }
    return null;
}
?>
