<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $error = false;
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $firstName = $_POST['firstname'] ?? '';
  $lastName = $_POST['name'] ?? '';
  $age = $_POST['age'] ?? '';
  $address = $_POST['address'] ?? '';
  $gender = $_POST['gender'] ?? '';
  $username = $firstName . '.' . $lastName;

  $user = [
      "User" => [
          "id" => time(),
          "login" => $email,
          "password" => password_hash($password, PASSWORD_DEFAULT),
          "role" => "client",
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
      ]
  ];

  $file = __DIR__ . "../data/users.json";
  if (file_exists($file)) {
      $content = file_get_contents($file);
      $users = json_decode($content, true);
      if (!is_array($users)) $users = [];
  } else {
      $users = [];
  }
  $users[] = $user;
  $json = json_encode($users, JSON_PRETTY_PRINT);
  if ($json === false) {
      echo "Erreur JSON : " . json_last_error_msg();
  } else {
      $result = file_put_contents($file, $json);
      if ($result === false) $error = "Internal server error, please try again.";
  }
}
?>
