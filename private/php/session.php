<?php

function start_session() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function get_users() {
    $file = file_get_contents(__DIR__ . "/../data/users.json");
    return json_decode($file, true)["users"] ?? [];
}

function find_user_by_email($email) {
    foreach (get_users() as $user) {
        if ($user["email"] === $email) {
            return $user;
        }
    }
    return null;
}

function login($email, $password) {
    start_session();

    $user = find_user_by_email($email);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_email"] = $user["email"];
        return true;
    }

    return false;
}

function logout() {
    start_session();
    session_unset();
    session_destroy();
}

function is_logged_in() {
    start_session();
    return isset($_SESSION["user_email"]);
}

function get_user_by_session() {
    start_session();

    if (!isset($_SESSION["user_email"])) {
        return null;
    }

    return find_user_by_email($_SESSION["user_email"]);
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: /login.php");
        exit();
    }
}