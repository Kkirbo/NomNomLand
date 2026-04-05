<?php 
require '../../private/php/session.php';
require_login();
$user = get_user_by_session();
if (!$user || ($user['role'] !== 'admin' && $user['role'] !== 'cook' && $user['role'] !== 'delivery')) redirect_url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/orders.css">
</head>
<body>

    <?php

    require_once "../../private/php/data_loader.php";

    $deliveryPeople = getDeliveryPeople();
    $orders = getOrders();

    ?>

    <?php include 'sidebar.php'; ?>

    <section class="orders">

        <h2>Pending Orders</h2>

        <?php foreach ($orders as $order): ?>
        <?php if (!in_array($order["delivery"]["status"], array("success", "failed"))): ?>

        <?php
        $isReady = $order["delivery"]["status"] == "ready";
        $isPreparing = $order["delivery"]["status"] == "preparing";
        $isdelivery = $order["delivery"]["status"] == "delivery";
        ?>

        <article class="menu modernNeonBoxGlassAdmin orderCard">

            <h3>Order #<?= $order['id'] ?></h3>

            <ul>
                <li><strong>Customer Email:</strong> <?= $order['email'] ?></li>
                <li><strong>Arrival Date:</strong> <?= $order['date'] ?></li>
            </ul>

            <?php $toggleId = "order-toggle-" . $order['id']; ?>

            <input type="checkbox" id="<?= $toggleId ?>" class="modalToggle">

            <label for="<?= $toggleId ?>" class="openModalBtn">
                Display Details
            </label>

            <div class="modal">
                <label for="<?= $toggleId ?>" class="overlay"></label>

                <div class="modalContent modernNeonBoxGlass">

                    <h3>Order #<?= $order['id'] ?> Details</h3>

                    <ul>
                        <?php foreach ($order['content'] as $item): ?>
                            <li><?= $item ?></li>
                        <?php endforeach; ?>

                    </ul>
                    
                    <p><strong>Status:</strong> <?= $order['delivery']['status'] ?></p>
                    <p><strong>Adress:</strong> <?= $order['delivery']['address'] ?></p>
                    <p><strong>Total:</strong> <?= $order['price'] ?>$</p>

                    <p><strong>Delivery person:</strong>
                        <?= getDeliveryName($order["delivery"]["delivery_person_id"] ?? null, ) ?>
                    </p>
                    
                    <?php if ($isReady): ?>
                        <form action="../../private/php/update_order_status.php" method="POST">
                            <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
                            <input type="hidden" name="status" value="preparing">
                            <button type="submit">Start Preparation</button>
                        </form>
                    <?php endif ?>

                    <?php if ($isPreparing): ?>
                        <form action="../../private/php/update_order_status.php" method="POST">
                            <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
                            
                            
                            <input type="hidden" name="status" value="delivery">
                            <button type="submit">Send to Delivery</button>
                            
                            <select name="delivery_person_id" required>
                                <?php foreach ($deliveryPeople as $user): ?>
                                    <option value="<?= $user['id'] ?>">
                                        <?= getDeliveryName($user['id']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </form>
                    <?php endif ?>

                    <label for="<?= $toggleId ?>" class="closeBtn">
                        Close
                    </label>

                </div>
            </div>

        </article>
        <?php endif; ?>
        <?php endforeach; ?>

</body>
</html>
