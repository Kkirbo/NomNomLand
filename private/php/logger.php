<?php
function logIncident($user, $event) {
    $date = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $username = $user["profile"]["username"] ?? "Unknown";
    $email = $user["email"] ?? "Unknown";
    $status = $user["status"] ?? "Unknown";
    $role = $user["role"] ?? "Unknown";
    $line ="[$date] " ."[IP:$ip] " ."[USER:$username] " ."[EMAIL:$email] " ."[ROLE:$role] " ."[STATUS:$status] " ."$event" .PHP_EOL;
    file_put_contents(__DIR__ . "/../logs/logs.txt",$line,FILE_APPEND | LOCK_EX);
}
?>