<?php
require '../../private/php/session.php';
require_login();
$user = get_user_by_session();
session_start();
if(isset($_POST['dish_id'])){
    $dishId=$_POST['dish_id'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$dishId])) {
        $_SESSION['cart'][$dishId]++;
    } else {
        $_SESSION['cart'][$dishId] = 1;
    }
}
$dish = [
        "id" => $_POST['dish_id'],
        "fidelity" => 0,
        "amount" => $_SESSION['cart'][$dishId],
    ];
json_encode($dish, PRETTY_PRINT);
header('Location: menu.php');
exit();