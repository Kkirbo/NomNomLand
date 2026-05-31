<?php
require '../../private/php/session.php';
require_once "../../private/php/utilities/data.php";

require_login();

$user = get_user_by_session();

if (is_user_last_order_unpaid($user['id'])) {
    header("Location: payment.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Cart</title>

    <link rel="icon" href="../assets/icons/logo.ico">

    <link rel="stylesheet" href="../styles/index.css">

    <link rel="stylesheet" href="../styles/cart.css">

    <script defer type="module" src="../scripts/cart.js"></script>
    <script defer type="module" src="../scripts/display-latest-order.js"></script>
    <script defer src="../scripts/status.js"></script>
</head>

<body>
<?php include 'cookiebanner.php'; ?>

<?php include 'header.html'; ?>

<?php include 'sidebar.php'; ?>

<main>

    <section class="infos">
        <h2>Your Cart</h2>
        <article class="modernNeonBoxGlass cartContainer">
            <h3>Total: <span class="price">0€</span></h3>
            <div class="ordersContainer cart modernNeonBoxGlass">
                <p>Your cart is empty.</p>
                <a href="menu.php">
                    Visit the menu
                </a>
            </div>
            <button class="placeOrder hidden" class="button">Place Order</button>
        </article>
    </section>
    <section id="id" class="background-blur modal">
        <article class="modalContent modernNeonBoxGlass">
            <h2>1. Select Options:</h2>
            <form action="" method="post" class="options">
                <div class="option"><input type="checkbox" name="salt" id="salt"><label for="salt">Salt</label></div>
                <div class="option"><input type="checkbox" name="fries" id="fries"><label for="fries">Extra Fries</label></div>
                <div class="option"><input type="checkbox" name="priority" id="priority"><label for="priority">Urgent Delivery</label></div>
                <div class="option"><div class="input"><input type="number" name="tip" id="tip" placeholder="0" min="0" max="100">%</div> Tip</div>
            </form>
            <h2>2. Choose where you want to eat</h2>
            <h3>Reserve a table</h3>
            <form action="" method="post" class="bookTable"></form>
            <h3>At Home (<?= $user['profile']['address'] ?>)</h3>
            <button name="placeOrder" class="placeOrder">Get it delivered</button>
        </article>
    </section>

    <section class="infos">
        <h2>My Orders</h2>
        <article class="card modernNeonBoxGlass">
            <div class="ordersContainer latestOrder modernNeonBoxGlass">
                <p>You have no past order.</p>
            </div>
            <a href="orders.php">View my Orders</a>
        </article>
    </section>

</main>

<?php include 'footer.html'; ?>

</body>
</html>

