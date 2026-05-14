<?php
if (isset($_SESSION["user_email"])) header("Location: index.php");
$error = '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
if (!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password'])) {
    $error = "Please fill in all fields.";
    return;
}
$login = login($_POST['email'], $_POST['password']);
if ($login == 1) $error = "Please fill in all fields.";
else if ($login == 2) $error = "Invalid credentials, please try again.";

?>