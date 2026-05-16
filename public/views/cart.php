<?php
require '../../private/php/session.php';
require '../../private/php/cart.php';
require_once "../../private/php/utilities/data.php";
require_login();
$user = get_user_by_session();

$error = '';
if (is_user_last_order_unpaid($user['id'])) {
    header("Location: payment.php");
    exit();
}

date_default_timezone_set('Pacific/Palau');

$username = $user['email'];

$cartData = get_cart();

$optionsData = load_data("options.json", "options")['options'] ?? [];

$optionsById = [];
foreach ($optionsData as $o) $optionsById[$o['id']] = $o;

function calculateItemPrice($basePrice, $selectedOptions, $optionsById) {
    $price = $basePrice;

    foreach ($selectedOptions as $optId) {
        $opt = $optionsById[$optId] ?? null;
        if ($opt == null) continue;

        if ($opt['type'] === 'ingredient_modification') {
            $price *= 1 + ($opt['priceImpact'] ?? 0);
        }

        if ($opt['type'] === 'coupon') {
            $price *= 1 - (($opt['discountPercentage'] ?? 0) / 100);
        }
    }

    return round($price, 2);
}

// --- Actions POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Supprimer un item
    if (isset($_POST['remove'])) {
        remove_cart_item($username, $_POST['id'], $_POST['type'] ?? 'solo');
        header('Location: cart.php');
        exit();
    }

    // Commander
    if (isset($_POST['place_order'])) {

        $orderContent = [];
        $orderOptions = [];
        $totalPrice = 0;

        foreach ($cartData['soloItems'] ?? [] as $item) {
            if ($item['user'] !== $username) continue;

            $dish = get_dish_by_id($item['id']);
            if (!$dish || !isset($dish['price'])) continue;

            $orderContent[] = $dish['title'];
            $totalPrice += $dish['price'] * $item['quantity'];
        }

        foreach ($cartData['items'] ?? [] as $item) {
            if ($item['user'] !== $username) continue;

            $menu = get_menu_by_id($item['id']);
            if (!$menu || !isset($menu['price'])) continue;

            $selectedOptions = $_POST['options'][$item['id']] ?? [];
            $menuPrice = calculateItemPrice($menu['price'], $selectedOptions, $optionsById);

            $orderContent[] = $menu['title'];

            foreach ($selectedOptions as $optId) {
                $opt = $optionsById[$optId] ?? null;
                if ($opt) {
                    $orderOptions[] = $opt['description'] ?? $opt['couponCode'] ?? '';
                }
            }

            $totalPrice += $menuPrice * $item['quantity'];
        }

        if (empty($orderContent)) {
            header('Location: cart.php?error=empty');
            exit();
        }

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

        clear_user_cart($username);

        header('Location: cart.php?ordered=1');
        exit();
    }
}

// Calcul total items
$totalItems = 0;

foreach ($cartData['soloItems'] ?? [] as $item) {
    if ($item['user'] !== $username) continue;

    $dish = get_dish_by_id($item['id']);
    if (!$dish || !isset($dish['price'])) continue;

    $totalItems += $item['quantity'];
}

foreach ($cartData['items'] ?? [] as $item) {
    if ($item['user'] !== $username) continue;

    $menu = get_menu_by_id($item['id']);
    if (!$menu || !isset($menu['price'])) continue;

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
                <p class="success-message">Your order has been placed!</p>
            <?php endif; ?>

            <?php if(isset($_GET['error']) && $_GET['error'] === 'empty'): ?>
                <p class="error-message">Your cart is empty!</p>
            <?php endif; ?>

            <h1>Solo Items</h1>
            <ul class="cart-list">
                <form method="post">
                    <?php foreach($cartData['soloItems'] ?? [] as $item):
                        if ($item['user'] !== $username) continue;

                        $dish = get_dish_by_id($item['id']);
                        if (!$dish || !isset($dish['price'])) continue;
                    ?>
                    <li class="cart-item">
                        <span><?= htmlspecialchars($dish['title']) ?></span>
                        <span>Quantity: <?= $item['quantity'] ?></span>
                        <span><?= number_format($dish['price'] * $item['quantity'], 2) ?> €</span>

                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <input type="hidden" name="type" value="solo">
                        <button type="submit" name="remove">Remove</button>
                    </li>
                    <?php endforeach; ?>
                </form>
            </ul>

            <h1>Menus</h1>
            <ul class="cart-list">
                <form method="post">
                    <?php foreach($cartData['items'] ?? [] as $item):
                        if ($item['user'] !== $username) continue;

                        $menu = get_menu_by_id($item['id']);
                        if (!$menu || !isset($menu['price'])) continue;
                    ?>
                    <li class="cart-item">
                        <span><?= htmlspecialchars($menu['title']) ?></span>
                        <span>Quantity: <?= $item['quantity'] ?></span>

                        <div class="cart-item-options">
                            <?php foreach($optionsData as $opt): ?>
                                <?php if($opt['type']==='ingredient_modification' || $opt['type']==='coupon'): ?>
                                    <label>
                                        <input type="checkbox" name="options[<?= $item['id'] ?>][]" value="<?= $opt['id'] ?>">
                                        <?= htmlspecialchars($opt['description'] ?? $opt['couponCode']) ?>
                                    </label>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>

                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <input type="hidden" name="type" value="menu">
                        <button type="submit" name="remove">Remove</button>
                    </li>
                    <?php endforeach; ?>
                </form>
            </ul>

            <!-- FORM COMMANDE (séparé) -->
            <form method="post">
                <?php if ($totalItems > 0): ?>
                    <button type="submit" name="place_order" class="button">Order</button>
                <?php else: ?>
                    <a href="menu.php">Go to the menu</a>
                <?php endif; ?>
            </form>
        </article>
    </section>

</main>

<?php include 'footer.html'; ?>
</body>
</html>