<?php
$path ="../data/users.json";
$data = json_decode(file_get_contents($path), true);
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
 foreach ($data['users'] as &$user) {
            if ($user['email'] === $email) {
                $user['lastLogin'] = date("Y-m-d H:i:s");
                break;
            }
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
 }
?>