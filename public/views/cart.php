
<?php
require '../../private/php/session.php';
require '../../private/php/cart.php';
require_once "../../private/php/utilities/data.php";

require_login();

$user = get_user_by_session();

/*if (is_user_last_order_unpaid($user['id'])) {
    header("Location: payment.php");
    exit();
}*/

date_default_timezone_set('Pacific/Palau');

$cartData = get_cart();

$optionsData = load_data("options.json", "options")['options'] ?? [];

$optionsById = [];
foreach ($optionsData as $o) {
    $optionsById[$o['id']] = $o;
}

function calculateItemPrice($basePrice, $selectedOptions, $optionsById) {
    $price = $basePrice;

    foreach ($selectedOptions as $optId) {

        $opt = $optionsById[$optId] ?? null;

        if (!$opt) continue;

        if ($opt['type'] === 'ingredient_modification') {
            $price *= 1 + ($opt['priceImpact'] ?? 0);
        }

        if ($opt['type'] === 'coupon') {
            $price *= 1 - (($opt['discountPercentage'] ?? 0) / 100);
        }
    }

    return round($price, 2);
}

/**
 * POST ACTIONS
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /**
     * REMOVE ITEM
     */
    if (isset($_POST['remove'])) {

        remove_cart_item(
            $user['id'],
            $_POST['id'],
            $_POST['type'] ?? 'solo'
        );

        header('Location: cart.php');
        exit();
    }

    /**
     * PLACE ORDER
     */
    if (isset($_POST['place_order'])) {

        $orderContent = [];
        $orderOptions = [];
        $totalPrice = 0;

        /**
         * SOLO ITEMS
         */
        foreach ($cartData['soloItems'] ?? [] as $item) {

            if (($item['user_id'] ?? null) !== $user['id']) {
                continue;
            }

            $dish = get_dish_by_id($item['id']);

            if (!$dish || !isset($dish['price'])) {
                continue;
            }

            // IMPORTANT:
            // on stocke l'ID et NON le titre
            $orderContent[] = $dish['id'];

            $totalPrice += $dish['price'] * $item['quantity'];
        }

        /**
         * MENUS
         */
        foreach ($cartData['items'] ?? [] as $item) {

            if (($item['user_id'] ?? null) !== $user['id']) {
                continue;
            }

            $menu = get_menu_by_id($item['id']);

            if (!$menu || !isset($menu['price'])) {
                continue;
            }

            $selectedOptions = $_POST['options'][$item['id']] ?? [];

            $menuPrice = calculateItemPrice(
                $menu['price'],
                $selectedOptions,
                $optionsById
            );

            // IMPORTANT:
            // on stocke l'ID
            $orderContent[] = $menu['id'];

            foreach ($selectedOptions as $optId) {

                $opt = $optionsById[$optId] ?? null;

                if (!$opt) continue;

                $orderOptions[] =
                    $opt['description']
                    ?? $opt['couponCode']
                    ?? '';
            }

            $totalPrice += $menuPrice * $item['quantity'];
        }

        /**
         * EMPTY CART CHECK
         */
        if (empty($orderContent)) {
            header('Location: cart.php?error=empty');
            exit();
        }

        /**
         * CREATE ORDER
         */
        $order = [
            'id' => uniqid(),
            'user_id' => $user['id'],
            'phone' => $user['phone'] ?? '',
            'content' => $orderContent,
            'options' => $orderOptions,

            'delivery' => [
                'status' => 'pending',
                'address' => $user['address'] ?? '',
                'delivery_person_id' => ''
            ],

            'price' => round($totalPrice, 2),
            'paymentStatus' => 'pending',
            'date' => date('Y-m-d H:i')
        ];

        add_order($order);

        clear_user_cart($user['id']);

        header('Location: cart.php?ordered=1');
        exit();
    }
}

/**
 * TOTAL ITEMS
 */
$totalItems = 0;

/**
 * SOLO ITEMS COUNT
 */
foreach ($cartData['soloItems'] ?? [] as $item) {

    if (($item['user_id'] ?? null) !== $user['id']) {
        continue;
    }

    $dish = get_dish_by_id($item['id']);

    if (!$dish || !isset($dish['price'])) {
        continue;
    }

    $totalItems += $item['quantity'];
}

/**
 * MENU ITEMS COUNT
 */
foreach ($cartData['items'] ?? [] as $item) {

    if (($item['user_id'] ?? null) !== $user['id']) {
        continue;
    }

    $menu = get_menu_by_id($item['id']);

    if (!$menu || !isset($menu['price'])) {
        continue;
    }

    $totalItems += $item['quantity'];
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

</head>

<body>

<?php include 'header.html'; ?>

<?php include 'sidebar.php'; ?>

<main class="cart-container">

    <section class="infos">

        <h2>Your Cart</h2>

        <article class="modernNeonBoxGlass">

            <?php if(isset($_GET['ordered'])): ?>
                <p class="success-message">
                    Your order has been placed!
                </p>
            <?php endif; ?>

            <?php if(isset($_GET['error']) && $_GET['error'] === 'empty'): ?>
                <p class="error-message">
                    Your cart is empty!
                </p>
            <?php endif; ?>

            <!-- SOLO ITEMS -->

            <h1>Solo Items</h1>

            <ul class="cart-list">

                <form method="post">

                    <?php foreach($cartData['soloItems'] ?? [] as $item): ?>

                        <?php
                        if (($item['user_id'] ?? null) !== $user['id']) {
                            continue;
                        }

                        $dish = get_dish_by_id($item['id']);

                        if (!$dish || !isset($dish['price'])) {
                            continue;
                        }
                        ?>

                        <li class="cart-item">

                            <span>
                                <?= htmlspecialchars($dish['title']) ?>
                            </span>

                            <span>
                                Quantity: <?= $item['quantity'] ?>
                            </span>

                            <span>
                                <?= number_format($dish['price'] * $item['quantity'], 2) ?> €
                            </span>

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $item['id'] ?>"
                            >

                            <input
                                type="hidden"
                                name="type"
                                value="solo"
                            >

                            <button type="submit" name="remove">
                                Remove
                            </button>

                        </li>

                    <?php endforeach; ?>

                </form>

            </ul>

            <!-- MENUS -->

            <h1>Menus</h1>

            <ul class="cart-list">

                <form method="post">

                    <?php foreach($cartData['items'] ?? [] as $item): ?>

                        <?php
                        if (($item['user_id'] ?? null) !== $user['id']) {
                            continue;
                        }

                        $menu = get_menu_by_id($item['id']);

                        if (!$menu || !isset($menu['price'])) {
                            continue;
                        }
                        ?>

                        <li class="cart-item">

                            <span>
                                <?= htmlspecialchars($menu['title']) ?>
                            </span>

                            <span>
                                Quantity: <?= $item['quantity'] ?>
                            </span>

                            <div class="cart-item-options">

                                <?php foreach($optionsData as $opt): ?>

                                    <?php if(
                                        $opt['type'] === 'ingredient_modification'
                                        || $opt['type'] === 'coupon'
                                    ): ?>

                                        <label>

                                            <input
                                                type="checkbox"
                                                name="options[<?= $item['id'] ?>][]"
                                                value="<?= $opt['id'] ?>"
                                            >

                                            <?= htmlspecialchars(
                                                $opt['description']
                                                ?? $opt['couponCode']
                                            ) ?>

                                        </label>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                            </div>

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $item['id'] ?>"
                            >

                            <input
                                type="hidden"
                                name="type"
                                value="menu"
                            >

                            <button type="submit" name="remove">
                                Remove
                            </button>

                        </li>

                    <?php endforeach; ?>

                </form>

            </ul>

            <!-- ORDER BUTTON -->

            <form method="post">

                <?php if ($totalItems > 0): ?>

                    <button
                        type="submit"
                        name="place_order"
                        class="button"
                    >
                        Order
                    </button>

                <?php else: ?>

                    <a href="menu.php">
                        Go to the menu
                    </a>

                <?php endif; ?>

            </form>

        </article>

    </section>

</main>

<?php include 'footer.html'; ?>

</body>
</html>

