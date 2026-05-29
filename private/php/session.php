<?php
require_once __DIR__ . "/utilities/data.php";
require_once __DIR__ . "/utilities/url.php";
if (session_status() === PHP_SESSION_NONE) session_start();

function is_logged_in() {
    return isset($_SESSION["user_id"]);
}

function is_role($user, $role) {
    return $user && $user["role"] == $role;
}
function is_any_role($user, $roles) {
    if (!$user) return false;
    foreach ($roles as $role) {
        if ($user["role"] == $role) return true;
    }
    return false;
}

function require_login() {
    if (!is_logged_in()) redirect_url("login.php?redirect=" . urlencode(basename($_SERVER['REQUEST_URI'])));
}

function get_user_by_session() {
    if (!is_logged_in()) {
        return null;
    }
    return get_user_by_id($_SESSION["user_id"]);
}

//Authentication and session creation
function login($email, $password) {
    if (empty($email) || empty($password)) {
        return 1; //At least 1 empty field
    }
    $user = get_user_by_email($email);
    if ($user['status'] == "deactivated") return 3; //Account deactivated

    if ($user && password_verify($password, $user["password"])) {
        date_default_timezone_set('Pacific/Palau');
        update_user_field($user["id"], "lastLogin", date("Y-m-d H:i:s"));

        $_SESSION["user_id"] = $user["id"];
        redirect_url();
        return 0; //Logged in successfully
    }

    return 2; //Invalid Credentials
}

function logout() {
    session_unset();
    session_destroy();
    redirect_url("login.php");
    exit();
}