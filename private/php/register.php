<?php
require_once __DIR__ . "/utilities/data.php";
if (is_logged_in()) redirect_url();
$error = '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
if (get_user_by_email($email) !== null) {
    $error = "An account with this email already exist. Please log in instead.";
    return;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
    return;
}
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
    $error = "Invalid phone number format.";
    return;
}
$password = $_POST['password'] ?? '';
if (strlen($password) < 8) {
    $error = "Password must be at least 8 characters long.";
    return;
}
$firstName = ucfirst(strtolower($_POST['firstname'] ?? ''));
$lastName = ucfirst(strtolower($_POST['name'] ?? ''));
$age = $_POST['age'] ?? '';
$age = (int) $age;
if (!is_numeric($age) || $age < 18 || $age > 120) {
    $error = "Age must be between 18 and 120.";
    return;
}
$address = $_POST['address'] ?? '';
$gender = $_POST['gender'] ?? 'other';
$username = $firstName . '.' . $lastName;

$user = [
    "id" => uniqid(),
    "email" => $email,
    "phone" => $phone,
    "password" => password_hash($password, PASSWORD_DEFAULT),
    "role" => "client",
    "status" => "Free",
    "fidelity" => 0,
    "profile" => [
        "firstName" => $firstName,
        "lastName" => $lastName,
        "username" => $username,
        "age" => $age,
        "address" => $address,
        "gender" => $gender
    ],
    "createdAt" => date("Y-m-d H:i:s"),
    "lastLogin" => null
];

if (register_user($user)) login($email, $password);
?>