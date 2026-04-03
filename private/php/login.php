<?php
session_start();
$error = false;
$email = $_POST['email'];
$password = $_POST['password'];
$file = file_get_contents("../../private/data/users.json");
$users = json_decode($file, true);
foreach ($users["users"] as $user) {
    if ($user["email"] === $email && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user;
        setcookie("user", $email, time() + 86400, "/");
        exit();
    }
}
if (isset($_POST['email']) && isset($_POST['password'])){
    $error = "Invalid credentials, please try again.";
}
?>
