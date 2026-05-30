<?php
require '../../private/php/session.php';
require '../../private/php/generate-nav.php';
require_once "../../private/php/utilities/data.php";
require_login();
$user = get_user_by_session();
//if (!is_any_role($user, ["admin", "cook", "delivery"])) redirect_url();

if (is_role($user, "delivery") && get_order_by_delivery_id($user['id']) !== null) {
    header('Location: delivery.php');
    exit();
}

$deliveryPeople = get_users_by_role("delivery");
if (is_role($user, "client")) $orders = get_orders_by_user_id($user['id']);
else $orders = get_orders();


/*if (is_role($user, "cook")) {
    $orders = array_filter($orders, function($order) {
        return $order["delivery"]['status'] !== 'delivery';
    });
}*/
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/orders.css">
    <link rel="stylesheet" href="../styles/order-preview.css">
    <script>
        const deliveryPeople = <?= json_encode($deliveryPeople) ?>;
    </script>
    <script defer type="module" src="../scripts/orders.js"></script>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <header>
        <h1>Orders</h1>
    </header>

    <main>
        <section class="orders">

            <?php foreach ($orders as $order): ?>

            <?php
            $isPending = $order["delivery"]["status"] == "pending";
            $isPreparing = $order["delivery"]["status"] == "preparing";
            $isReady = $order["delivery"]["status"] == "ready";
            $isRestaurant = $order["delivery"]["address"] == "restaurant";
            $isdelivery = $order["delivery"]["status"] == "delivery";
            ?>

            <?php $toggleId = "order-toggle-" . $order['id']; ?>
            <article class="menu orderCard modernNeonBoxGlass">

                <h3>#<?= $order['id'] ?></h3>

                <ul>
                    <li>User #<?= $order['user_id'] ?></li>
                    <li><? $orderUser = get_user_by_id($order['user_id']); echo ($orderUser ? $orderUser['email'] : "Undefined"); ?></li>
                    <li>$ <?= $order['price'] ?></li>
                    <li><?= $order['date'] ?></li>
                </ul>

                <label for="<?= $toggleId ?>" class="openModalBtn">
                    Display Details
                </label>
            </article>
            <div class="modal">
                <input type="checkbox" id="<?= $toggleId ?>" class="modalToggle">
                <label for="<?= $toggleId ?>" class="background-blur"></label>

                <div class="modalContent modernNeonBoxGlass">
                    <div class="ordersContainer modernNeonBoxGlass" data-id="<?= $order['id'] ?>"></div>

                    <?php
                        $deliveryPersonName = get_user_full_name($order["delivery"]["delivery_person_id"] ?? null);
                        if ($deliveryPersonName !== "None") echo '
                            <div class="modernNeonBoxGlass deliveryInfo">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M155-195q-35-35-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35q-50 0-85-35Zm113.5-56.5Q280-263 280-280t-11.5-28.5Q257-320 240-320t-28.5 11.5Q200-297 200-280t11.5 28.5Q223-240 240-240t28.5-11.5ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm628.5 108.5Q760-263 760-280t-11.5-28.5Q737-320 720-320t-28.5 11.5Q680-297 680-280t11.5 28.5Q703-240 720-240t28.5-11.5ZM680-440h170l-90-120h-80v120ZM360-540Z"/></svg>
                                <p>
                                    <span>Delivering:</span>
                                    <span class="delivery-person-name">' . $deliveryPersonName . '</span>
                                </p>
                            </div>
                        ';
                    ?>
                
                    <div class="order-actions">

                        <?php if ($isPending): ?>
                            <button
                                class="update-order-btn"
                                data-order-id="<?= $order['id'] ?>"
                                data-field="delivery->status"
                                data-value="preparing"
                                data-is-restaurant="<?= $isRestaurant ?>"
                            >
                                Prepare command
                            </button>
                        <?php endif ?>

                        <?php if ($isPreparing): ?>
                            <button
                                class="update-order-btn"
                                data-order-id="<?= $order['id'] ?>"
                                data-field="delivery->status"
                                data-value="ready"
                                data-is-restaurant="<?= $isRestaurant ?>"
                            >
                                Put command as ready
                            </button>
                        <?php endif ?>

                        <?php if ($isReady && !$isRestaurant): ?>
                            <select class="delivery-person-select">
                                <?php foreach ($deliveryPeople as $deliveryPerson): ?>
                                    <option value="<?= $deliveryPerson['id'] ?>" class="delivery-person-name">
                                        <?= get_user_full_name($deliveryPerson['id']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <button
                                class="update-order-btn"
                                data-order-id="<?= $order['id'] ?>"
                                data-field="delivery->status"
                                data-value="delivery"
                                data-is-restaurant="<?= $isRestaurant ?>"
                            >
                                Send to Delivery
                            </button>
                        <?php endif ?>

                        <?php if ($isReady && $isRestaurant): ?>
                            <button
                                class="update-order-btn"
                                data-order-id="<?= $order['id'] ?>"
                                data-field="delivery->status"
                                data-value="success"
                                data-is-restaurant="<?= $isRestaurant ?>"
                            >
                                Send to a waiter.
                            </button>
                        <?php endif ?>

                    </div>

                    <label for="<?= $toggleId ?>" class="closeBtn">
                        Close
                    </label>

                </div>
            </div>
            <?php endforeach; ?>
        </section>
        <?php
            generateNavbar($page, $pagesCount);
        ?>
    </main>

    <?php include 'footer.html'; ?>
</body>
</html>
