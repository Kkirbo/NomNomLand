<?php
if (session_status() === PHP_SESSION_NONE) session_start();

//Redirects the user based on the redirect parameter of the url (useful for going back to a page after login)
function redirect_url($default="/public/views/index.php") {
    $redirect = $_GET['redirect'] ?? $default;
    if (!is_string($redirect) || !str_starts_with($redirect, '/')) {
        $redirect = '/public/views/index.php';
    }
    header("Location: " . $redirect);
    exit();
}

function get_users() {
    $file = file_get_contents(__DIR__ . "/../data/users.json");
    if (!$file) {
        return [];
    }
    $data = json_decode($file, true);
    if (!$data || !isset($data["users"])) {
        return [];
    }
    return $data['users'];
}
function get_user_lastdish($email) {
    $file = file_get_contents(__DIR__ . "/../data/orders.json");
    $orders = json_decode($file, true);
    $lastOrder = null;
    foreach ($orders as $order) {
        if ($order["email"] !== $email) {
            continue;
        }
        if (!isset($order["delivery"]["status"]) ||$order/*["delivery"]["status"]*/["paymentStatus"] !== "success") { 
            continue;
        }
    if ($lastOrder === null ||strtotime($order["date"]) > strtotime($lastOrder["date"])){
        $lastOrder = $order;
        }
    }
    if ($lastOrder === null) {
        return null;
    }
    else{
        return $lastOrder["content"];
    }
}
function IsAdmin($user) {
    if ($user["role"] === 'admin') {
        return true;
    }
    else{
        return false;
    }
}
function IsClient($user) {
    if ($user["role"] === 'client') {
        return true;
    }
    else{
        return false;
    }
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

//Authentication and session creation
function login($email, $password) {
    if (empty($email) || empty($password)) {
        return 1; //at least 1 empty field
    }
    $user = get_user_by_email($email);

    if ($user && password_verify($password, $user["password"])) {
        $path = __DIR__ . "/../data/users.json";
        $data = json_decode(file_get_contents($path), true);
        foreach ($data['users'] as &$user) {
            if ($user['email'] === $email) {
                $user['lastLogin'] = date("Y-m-d H:i:s");
                break;
            }
    }
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
        $_SESSION["user_email"] = $user["email"];
        redirect_url();
        return 0; //Logged in successfully
    }

    return 2; //Invalid Credentials
}

function logout() {
    session_unset();
    session_destroy();
    redirect_url("/public/views/login.php");
    exit();
}

function is_logged_in() {
    return isset($_SESSION["user_email"]);
}

function get_user_by_session() {
    if (!isset($_SESSION["user_email"])) {
        return null;
    }

    return get_user_by_email($_SESSION["user_email"]);
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: /public/views/login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }
}
function get_dishes() {
    $file = file_get_contents(__DIR__ . "/../data/dishes.json");
    if (!$file) {
        return [];
    }
    $data = json_decode($file, true);
    if (!$data || !isset($data["dishes"])) {
        return [];
    }
    return $data["dishes"];
}
function get_dish_by_title($title) {
    foreach (get_dishes() as $dish) {
        if ($dish["title"] === $title) {
            return $dish;
        }
    }
    return null;
}
function count_dishes($contents) {

    $counted = [];
    foreach ($contents as $dish) {
        if (!isset($counted[$dish])) {
            $counted[$dish] = 1;
        }
        else {
            $counted[$dish]++;
        }
    }
    return $counted;
}