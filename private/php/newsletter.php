<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
    return;
}

$path = __DIR__ . "/../data/newsletter.json";

$data = [];
if (file_exists($path)) {
    $content = file_get_contents($path);
    $data = json_decode($content, true);
}
if (!is_array($data)) {
    $data = [];
}
if (in_array($email, $data)) {
    $error = "This email is already subscribed.";
    return;
}
$data[] = $email;

$json = json_encode($data, JSON_PRETTY_PRINT);

if ($json === false) {
    $error = "JSON Error : " . json_last_error_msg();
    return;
} 
$result = file_put_contents($path, $json);
if ($result === false) {
    $error = "Internal server error, please try again.";
}
?>