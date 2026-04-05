<?php
session_start();
require '../../private/php/session.php';
require_login();
date_default_timezone_set('Europe/Paris');
$user = get_user_by_session();
if (!$user) exit();

$username = $user['email'];

$dataPath = realpath(__DIR__ . '/../../private/data');
$commandsFile = $dataPath . '/commands.json';
$dishesFile   = $dataPath . '/dishes.json';
$menusFile    = $dataPath . '/menus.json';
$optionsFile  = $dataPath . '/options.json';
$ordersFile   = $dataPath . '/orders.json';

function loadJson($file) {
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return $data ?: [];
}

function saveJson($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

$cartData = loadJson($commandsFile);
$dishesData = loadJson($dishesFile)['dishes'] ?? [];
$menusData  = loadJson($menusFile)['menus'] ?? [];
$optionsData = loadJson($optionsFile)['options'] ?? [];

// Indexation
$dishesById = [];
foreach ($dishesData as $d) $dishesById[$d['id']] = $d;

$menusById = [];
foreach ($menusData as $m) $menusById[$m['id']] = $m;

$optionsById = [];
foreach ($optionsData as $o) $optionsById[$o['id']] = $o;

// Fonctions
function removeFromCart(&$cart, $user, $id, $type='solo') {
    $key = $type==='solo' ? 'soloItems' : 'items';
    $cart[$key] = array_filter($cart[$key], fn($i)=>!($i['user']===$user && $i['id']===$id));
}

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
        removeFromCart($cartData, $username, $_POST['id'], $_POST['type'] ?? 'solo');
        saveJson($commandsFile, $cartData);
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

            $dish = $dishesById[$item['id']] ?? null;
            if (!$dish || !isset($dish['price'])) continue;

            $orderContent[] = $dish['title'];
            $totalPrice += $dish['price'] * $item['quantity'];
        }

        foreach ($cartData['items'] ?? [] as $item) {
            if ($item['user'] !== $username) continue;

            $menu = $menusById[$item['id']] ?? null;
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

        $orders = loadJson($ordersFile);

        $orders[] = [
            'id' => strval(count($orders)),
            'email' => $username,
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

        saveJson($ordersFile, $orders);

        // Vider panier utilisateur
        $cartData['soloItems'] = array_filter($cartData['soloItems'] ?? [], fn($i)=>$i['user']!==$username);
        $cartData['items'] = array_filter($cartData['items'] ?? [], fn($i)=>$i['user']!==$username);

        saveJson($commandsFile, $cartData);

        header('Location: cart.php?ordered=1');
        exit();
    }
}

// Calcul total items
$totalItems = 0;

foreach ($cartData['soloItems'] ?? [] as $item) {
    if ($item['user'] !== $username) continue;

    $dish = $dishesById[$item['id']] ?? null;
    if (!$dish || !isset($dish['price'])) continue;

    $totalItems += $item['quantity'];
}

foreach ($cartData['items'] ?? [] as $item) {
    if ($item['user'] !== $username) continue;

    $menu = $menusById[$item['id']] ?? null;
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
    <h1 class="cart-title">Your Cart</h1>

    <?php if(isset($_GET['ordered'])): ?>
        <p class="success-message">Your order has been placed!</p>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] === 'empty'): ?>
        <p class="error-message">Your cart is empty!</p>
    <?php endif; ?>

    <h2>Solo Items</h2>
    <ul class="cart-list">
        <?php foreach($cartData['soloItems'] ?? [] as $item):
            if ($item['user'] !== $username) continue;

            $dish = $dishesById[$item['id']] ?? null;
            if (!$dish || !isset($dish['price'])) continue;
        ?>
        <li class="cart-item">
            <span><?= htmlspecialchars($dish['title']) ?></span>
            <span>Quantity: <?= $item['quantity'] ?></span>
            <span><?= number_format($dish['price'] * $item['quantity'], 2) ?> €</span>

            <form method="post" class="inline-form">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <input type="hidden" name="type" value="solo">
                <button type="submit" name="remove">Remove</button>
            </form>
        </li>
        <?php endforeach; ?>
    </ul>

    <h2>Menus</h2>
    <ul class="cart-list">
        <?php foreach($cartData['items'] ?? [] as $item):
            if ($item['user'] !== $username) continue;

            $menu = $menusById[$item['id']] ?? null;
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

            <form method="post" class="inline-form">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <input type="hidden" name="type" value="menu">
                <button type="submit" name="remove">Remove</button>
            </form>
        </li>
        <?php endforeach; ?>
    </ul>

    <!-- FORM COMMANDE (séparé) -->
    <form method="post">
        <?php if ($totalItems > 0): ?>
            <button type="submit" name="place_order" class="button">Commander</button>
        <?php else: ?>
            <a href="menu.php" class="button">Go to menu</a>
        <?php endif; ?>
    </form>

</main>

<?php include 'footer.html'; ?>
</body>
</html>