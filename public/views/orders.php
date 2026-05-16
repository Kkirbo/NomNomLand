<?php
require '../../private/php/session.php';
require '../../private/php/generate-nav.php';
require_once "../../private/php/utilities/data.php";
require_login();
$user = get_user_by_session();
if (!is_any_role($user, ["admin", "cook", "delivery"])) redirect_url();

if (is_role($user, "delivery") && get_order_by_delivery_id($user['id']) !== null) {
    header('Location: delivery.php');
    exit();
}
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
    $deliveryPeople = get_users_by_role("delivery");
    $orders = get_orders();


    if (is_role($user, "cook")) {
      $orders = array_filter($orders, function($order) {
        return $order["delivery"]['status'] !== 'delivery';
      });
    }
    if (is_role($user, "delivery")) {
        $orders = array_filter($orders, function($order) {
            return in_array($order["delivery"]['status'], array("ready", "delivery"));
        });
    }

    $orders = array_reverse($orders);

    $visibleOrders = 6;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $pagesCount = computePages($orders, $visibleOrders);
    $orders = sliceArrayToPage($orders, $visibleOrders, $page, $pagesCount);
    ?>

    <?php include 'sidebar.php'; ?>

    <h2>Pending Orders</h2>

    <section class="orders">

        <?php foreach ($orders as $order): ?>
        <?php /*if (!in_array($order["delivery"]["status"], array("success", "failed"))):*/ ?>

        <?php
        $isPending = $order["delivery"]["status"] == "pending";
        $isReady = $order["delivery"]["status"] == "ready";
        $isPreparing = $order["delivery"]["status"] == "preparing";
        $isdelivery = $order["delivery"]["status"] == "delivery";
        ?>

        <article class="menu orderCard">

            <h3>Order #<?= $order['id'] ?></h3>

            <ul>
                <li><strong>Customer Email:</strong> <? $orderUser = get_user_by_id($order['user_id']); echo ($orderUser ? $orderUser['email'] : "Undefined"); ?></li>
                <li><strong>Arrival Date:</strong> <?= $order['date'] ?></li>
            </ul>

            <?php $toggleId = "order-toggle-" . $order['id']; ?>

            <input type="checkbox" id="<?= $toggleId ?>" class="modalToggle">

            <label for="<?= $toggleId ?>" class="openModalBtn">
                Display Details
            </label>

            <div class="modal">
                <label for="<?= $toggleId ?>" class="background-blur"></label>

                <div class="modalContent modernNeonBoxGlass">

                    <h3>Order #<?= $order['id'] ?> Details</h3>

                    <ul>
                        <?php foreach ($order['content'] as $item): ?>
                            <li><?= $item ?></li>
                        <?php endforeach; ?>

                    </ul>

                    <p><strong>Status:</strong> <?= $order['delivery']['status'] ?></p>
                    <p><strong>Address:</strong> <?= $order['delivery']['address'] ?></p>
                    <p><strong>Total:</strong> <?= $order['price'] ?>$</p>

                    <p><strong>Delivery person:</strong>
                        <?= get_user_full_name($order["delivery"]["delivery_person_id"] ?? null) ?>
                    </p>

                    <?php if ($isPending): ?>
                        <form action="../../private/php/update_order_status.php" method="POST">
                            <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
                            <input type="hidden" name="status" value="ready">
                            <button type="submit">Put command as ready</button>
                        </form>
                    <?php endif ?>

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
                                <?php foreach ($deliveryPeople as $deliveryPerson): ?>
                                    <option value="<?= $deliveryPerson['id'] ?>">
                                        <?= get_user_full_name($deliveryPerson['id']) ?>
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
        <?php /*endif;*/ ?>
        <?php endforeach; ?>
    </section>
    <?php
        generateNavbar($page, $pagesCount);
    ?>

</body>
</html>
