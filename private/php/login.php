<?php
$error = '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
if (!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password'])) {
    $error = "Please fill in all fields.";
    return;
}
$email = $_POST['email'];
$password = $_POST['password'];
$users = json_decode(file_get_contents("../../private/data/users.json"), true);
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
$error = "Invalid credentials, please try again.";
?>
