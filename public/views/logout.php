<?php session_start(); ?>
<?php
  require '../../private/php/session.php';

  logout();
  header("Location: login.php");
  exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
</html>
