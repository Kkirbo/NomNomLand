<?php
if (isset($_SESSION["user_email"])) header("Location: index.php");
$error = '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
if (!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password'])) {
    $error = "Please fill in all fields.";
    return;
}
$email = $_POST['email'];
$password = $_POST['password'];
$file = file_get_contents(__DIR__ . "/../data/users.json");
if (!$file) {
    $error = "Database error, please try again.";
    return;
}
$users = json_decode($file, true);
if (!$users || !isset($users["users"])) {
    $error = "Internal server error, please try again.";
    return;
}
foreach ($users["users"] as $user) {
    if ($user["email"] === $email && password_verify($password, $user["password"])) {
        $_SESSION["user_email"] = $user["email"];
        $redirect = $_GET['redirect'] ?? "index.php";
        if (!str_starts_with($redirect, '/')) {
            $redirect = 'index.php';
        }
        header("Location: " . $redirect);
        exit();
    }
}
if (!isset($_SESSION["user_email"])) $error = "Invalid credentials, please try again.";
?>
