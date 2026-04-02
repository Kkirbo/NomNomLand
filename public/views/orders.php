<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>

    <?php

    require_once "../../private/php/data_loader.php";
    require_once "../../private/php/helper.php";

    $deliveryPeople = getDeliveryPeople();
    $orders = getOrders();

    ?>

    <?php include 'sidebar.php'; ?>

    <section class="orders">

        <h2>Pending Orders</h2>

        <?php foreach ($orders as $order): ?>

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
                        <?= getDeliveryName($order["delivery"]["delivery_person_id"] ?? null, $deliveryPeople) ?>
                    </p>

                    <form action="../../private/php/update_order_status.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        <input type="hidden" name="status" value="preparing">
                        <button type="submit">Start Preparation</button>
                    </form>

                    <form action="../../private/php/update_order_status.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        
                        
                        <input type="hidden" name="status" value="delivery">
                        <button type="submit">Send to Delivery</button>
                        
                        <select name="delivery_person_id" required>
                            <?php foreach ($deliveryPeople as $person): ?>
                                <option value="<?= $person['id'] ?>">
                                    <?= $person['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </form>

                    <label for="<?= $toggleId ?>" class="closeBtn">
                        Close
                    </label>

                </div>
            </div>

        </article>
        <?php endforeach; ?>

</body>
</html>
