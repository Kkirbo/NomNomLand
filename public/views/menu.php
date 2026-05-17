<?php
require '../../private/php/session.php';
$user = get_user_by_session();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <title>Menu</title>
</head>
<body>

<?php include __DIR__ . '/header.html'; ?>
<?php include __DIR__ . '/sidebar.php'; ?>

<main>
<?php include 'searchbar.php'; ?>
<section class="search-results"></section>
<section id="id" class="background-blur modal">
    <article class="modal_content modernNeonBox">
        <img src="../assets/images/default.png" class="background" alt="fork and knife default background">
        <div class="header">
            <a href="#" class="modal_close">&times;</a>
            <h2 class="dish-title">Title</h2>
        </div>
        <div class="description">
            <p class="dish-version">Version</p>
            <div class="dish-section">
                <h3>Architecture</h3>
                <ul>
                    <li>Information</li>
                </ul>
            </div>
            <p class="dish-footer">Comment</p>
        </div>
        <div class="footer">
            <div class="dish-section">
                <h3>Price</h3>
            </div>
            <form method="POST" action="../views/panier.php">
                <input type="hidden" name="dish_id" value="id">
                <h3 class="hidden">Starter</h3>
                <select name="starter" required disabled></select>
                <h3 class="hidden">Main Course</h3>
                <select name="main course" required disabled></select>
                <h3 class="hidden">Drink</h3>
                <select name="drink" required disabled></select>
                <h3 class="hidden">Dessert</h3>
                <select name="dessert" required disabled></select>
                <button type="submit">Add to cart</button>
            </form>
        </div>
    </article>
</section>
<script defer type="module" src="../scripts/menu-modal.js"></script>
<!--
    <h1 id="menuheader">Restaurant Menu</h1>
    <div class="menu-left">

    <h2 id="sousmenuheader">Menus</h2>
    <div class="cards-container" role="list">
    <?php
    $dataPath    = realpath(__DIR__ . '/../../private/data');
    $dishesFile  = $dataPath . '/dishes.json';
    $menusFile   = $dataPath . '/menus.json';
    $dishesData = file_exists($dishesFile) ? json_decode(file_get_contents($dishesFile), true) : ["dishes" => []];
    $menusData  = file_exists($menusFile) ? json_decode(file_get_contents($menusFile), true) : ["menus" => []];

    $username = $user["profile"]["firstName"] ?? "Guest";
    $dishesById = [];
    foreach ($dishesData["dishes"] ?? [] as $dish) {
        $dishesById[$dish["id"]] = $dish;
    }

    $categories = [
        "menuentrees"  => ["salad","bruschetta","garlic"],
        "menuplats"    => ["calzone","lasagna","margherita","penne","ravioli","carbonara","spaghetti"],
        "menudesserts" => ["tiramisu","gelato"],
        "menudrinks"   => ["latte","espresso","the","smoothie"],
        "others" => ["RTX"]
    ];

    foreach ($menusData["menus"] ?? [] as $menu) {
        echo '<article class="menu-card modernNeonBoxGlass">';
        echo '<img src="' . $menu["image"] . '" class="menu-img" alt="' . $menu["title"] . '">';
        echo '<h3>' . $menu["title"] . '</h3>';
        echo '<a href="#menu-' . $menu["id"] . '" class="card-btn">' . $menu["price"] . '€</a>';
        echo '</article>';
    }
    ?>
    </div>
    <h2>Others</h2>
    <div class="cards-container">
    <?php
    foreach ($categories as $catId => $list) {
        switch ($catId) {
            case "menuentrees":
                $label = "Entries";
                break;
            case "menuplats":
                $label = "Main meals";
                break;
            case "menudesserts":
                $label = "Desserts";
                break;
            case "menudrinks":
                $label = "Drinks";
                break;
            default:
                $label = ucfirst($catId);
        }

        echo '<article class="menu-card modernNeonBoxGlass basic">';
        echo '<h3>' . $label . '</h3>';
        echo '<a href="#' . $catId . '" class="card-btn card-btn-basic">More info...</a>';
        echo '</article>';
    }
    ?>
    </div>
    </div>
    <?php
    foreach ($menusData["menus"] ?? [] as $menu) {
        echo '<section id="' . $menu["id"] . '" class="background-blur modal">';
        echo '<article class="modal_content modernNeonBox">';
        echo '<a href="#" class="modal_close">&times;</a>';
        echo '<h2 class="dish-title">' . $menu["title"] . '</h2>';
        echo '<form method="POST" action="../views/panier.php">';

        echo '<input type="hidden" name="menu_id" value="' . $menu["id"] . '">';
        $sections = [
            "dishes" => "Main dish",
            "desserts" => "Dessert",
            "drinks" => "Drink"
        ];
        foreach ($sections as $key => $label) {
            if (!empty($menu[$key])) {
                echo '<div>';
                echo '<label>' . $label . '</label>';
                echo '<select name="' . $key . '" required>';

                foreach ($menu[$key] as $dishId) {
                    $dish = $dishesById[$dishId] ?? null;
                    $title = $dish["title"] ?? "Unknown";
                    if (!empty(allergensContained($dishesById[$dishId], $allergensFilter))) $title = '⚠ '. $title;
                    echo '<option value="' . $dishId . '">' . $title . '</option>';
                }

                echo '</select>';
                echo '</div>';
            }
        }
        echo '<button type="submit">Add menu to cart</button>';

        echo '</form>';
        echo '</article></section>';
    }
    ?>
    <?php
    foreach ($dishesData["dishes"] ?? [] as $dish) {
        echo '<section id="' . $dish["id"] . '" class="background-blur modal">';
        echo '<article class="modal_content modernNeonBox">';
        echo '<a href="#" class="modal_close">&times;</a>';
        echo '<h2 class="dish-title">' . $dish["title"] . '</h2>';
        echo '<img src="' . $dish["image"] . '" class="dish-img" alt="' . $dish["title"] . '">';
        echo '<form method="POST" action="../views/panier.php">';
        echo '<input type="hidden" name="dish_id" value="' . $dish["id"] . '">';
        echo '<button type="submit">Add to cart</button>';
        echo '</form>';
        echo '<p class="dish-version">' . ($dish["version"] ?? "") . '</p>';
        foreach ($dish["sections"] ?? [] as $section => $items) {
            echo '<div class="dish-section">';
            echo '<h3>' . $section . '</h3>';
            echo '<ul>';
            foreach ($items as $item) {
                echo '<li>' . $item . '</li>';
            }
            echo '</ul></div>';
        }
        echo '<div class="dish-section">';
        echo '<h3>Price</h3>';
        echo '<ul>';
        echo '<li>' . $dish["price"] . '€</li>';
        echo '</ul></div>';
        echo '<div class="dish-footer"><p>' . ($dish["comment"] ?? "") . '</p></div>';
        echo '</article></section>';
    }
    ?>
    <?php
    foreach ($categories as $cat => $list) {
        echo '<section id="' . $cat . '" class="background-blur modal">';
        echo '<article class="modal_content modernNeonBox">';
        echo '<a href="#" class="modal_close">&times;</a>';
        echo '<h2 class="dish-title basic">' . strtoupper($cat) . '</h2>';
        echo '<ul class="liste">';
        foreach ($list as $dishId) {
            $title = $dishesById[$dishId]["title"] ?? "Unknown";
            echo '<li class="texte"><a href="#' . $dishId . '" class="link">' . $title . '</a></li>';
        }
    echo '</ul></article></section>';
        }
    ?>
    <?php echo'<a href="cart.php" class="return0">Return 0: Check your cart ' . $username . '</a>';?>
-->
</main>

<?php include __DIR__ . '/footer.html'; ?>
</body>
</html>
