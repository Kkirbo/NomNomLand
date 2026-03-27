<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css"/>
    <link rel="stylesheet" href="../styles/menu.css"/>
    <title>Menu</title>
</head>
<body>
  <?php include '../php/header.html'; ?>

  <?php include '../php/sidebar.php'; ?>
  <?php require '../data/dishes.json' ?>

  <?php 
    $json = file_get_contents("data.json");
    $data = json_decode($json, true);
?>
 <h1 id="menuheader">Restaurant Menu</h1>
  <div class="menu-left">
    <h2 id="sousmenuheader">Menus</h2>
    