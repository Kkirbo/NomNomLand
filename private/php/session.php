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
function IsAdmin($user) {
    if $user["role"] === 'admin' {
        return true;
    }
    else{
        return false;
    }
}
function IsClient($user) {
    if $user["role"] === 'client' {
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
