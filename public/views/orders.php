<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <?php include '../../private/php/orders_data.php'; ?>
</head>
<body>

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

                    <!-- Form 1 -->
                    <form action="../../private/php/update_order_status.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        <input type="hidden" name="status" value="preparing">
                        <button type="submit">Start Preparation</button>
                    </form>

                    <!-- Form 2 -->
                    <form action="../../private/php/update_order_status.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        <input type="hidden" name="status" value="delivery">
                        <button type="submit">Send to Delivery</button>
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
