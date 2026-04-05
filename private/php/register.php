<?php
if (isset($_SESSION["user_email"])) header("Location: index.php");
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
$password = $_POST['password'] ?? '';
if (strlen($password) < 8) {
    $error = "Password must be at least 8 characters long.";
    return;
}
$firstName = $_POST['firstname'] ?? '';
$lastName = $_POST['name'] ?? '';
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
    "password" => password_hash($password, PASSWORD_DEFAULT),
    "role" => "client",
    "status" => "Free",
    "fidelity" => 0,
    "newsletter" => false,
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

$path = __DIR__ . "/../data/users.json";

if (file_exists($path)) {
    $content = file_get_contents($path);
    $data = json_decode($content, true);

    if (!isset($data['users']) || !is_array($data['users'])) {
        $data['users'] = [];
    }
} else {
    $data = ["users" => []];
}

$data['users'][] = $user;

$json = json_encode($data, JSON_PRETTY_PRINT);

if ($json === false) {
    echo "JSON Error: " . json_last_error_msg();
} else {
    $result = file_put_contents($path, $json);
    if ($result === false) {
        $error = "Internal server error, please try again.";
    } else {
        login($email, $password);
    }
}
?>