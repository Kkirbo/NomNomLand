<?php
require '../../private/php/session.php';
require_login();
$dataPath    = realpath(__DIR__ . '/../../private/data');
$dishesFile  = $dataPath . '/dishes.json';
$menusFile   = $dataPath . '/menus.json';
$dishesData = file_exists($dishesFile) ? json_decode(file_get_contents($dishesFile), true) : ["dishes" => []];
$menusData  = file_exists($menusFile) ? json_decode(file_get_contents($menusFile), true) : ["menus" => []];
$dishesById = [];
foreach ($dishesData["dishes"] ?? [] as $dish) {
    $dishesById[$dish["id"]] = $dish;
}

$categories = [
    "menuentrees"  => ["salad","bruschetta","garlic"],
    "menuplats"    => ["calzone","lasagna","margherita","penne","ravioli","carbonara","spaghetti"],
    "menudesserts" => ["tiramisu","gelato"],
    "menudrinks"   => ["latte","espresso","the","smoothie"]
];
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

<h1 id="menuheader">Restaurant Menu</h1>
<div class="menu-left">

<h2 id="sousmenuheader">Menus</h2>
<div class="cards-container" role="list">
<?php
foreach ($menusData["menus"] ?? [] as $menu) {
    echo '<article class="menu-card modernNeonBoxGlass">';
    echo '<img src="' . $menu["image"] . '" class="menu-img" alt="' . $menu["title"] . '">';
    echo '<h3>' . $menu["title"] . '</h3>';
    echo '<a href="#' . $menu["id"] . '" class="card-btn">' . $menu["price"] . '€</a>';
    echo '</article>';
}
?>
</div>
<h2>Others</h2>
<div class="cards-container">
<?php
foreach ($categories as $catId => $list) {
    $label = match ($catId) {
        "menuentrees" => "Entries",
        "menuplats" => "Main meals",
        "menudesserts" => "Desserts",
        "menudrinks" => "Drinks",
        default => ucfirst($catId)
    };
    echo '<article class="menu-card modernNeonBoxGlass basic">';
    echo '<h3>' . $label . '</h3>';
    echo '<a href="#' . $catId . '" class="card-btn card-btn-basic">More info...</a>';
    echo '</article>';
}
?>
</div>
</div>
<a href="panier.php" class="return0">End of the menu: return 0;</a>
<?php
foreach ($menusData["menus"] ?? [] as $menu) {
    echo '<div id="' . $menu["id"] . '" class="modal">';
    echo '<div class="modal_content modernNeonBox">';
    echo '<a href="#" class="modal_close">&times;</a>';
    echo '<h2 class="dish-title">' . $menu["title"] . '</h2>';
    echo '<ul class="liste">';
    foreach ($menu["dishes"] ?? [] as $dishId) {
        $title = $dishesById[$dishId]["title"] ?? "Unknown dish";
        echo '<li><a href="#' . $dishId . '" class="link">' . $title . '</a></li>';
    }
    echo '</ul></div></div>';
}
?>
<?php
foreach ($dishesData["dishes"] ?? [] as $dish) {
    echo '<div id="' . $dish["id"] . '" class="modal">';
    echo '<div class="modal_content modernNeonBox">';
    echo '<a href="#" class="modal_close">&times;</a>';
    echo '<h2 class="dish-title">' . $dish["title"] . '</h2>';
    echo '<img src="' . $dish["image"] . '" class="dish-img" alt="' . $dish["title"] . '">';

    echo '<form method="POST" action="../views/panier.php">';
    echo '<input type="hidden" name="dish_id" value="' . $dish["id"] . '">';
    echo '<button type="submit" class="add-to-cart">Ajouter au panier</button>';
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
    echo '<div class="dish-footer"><p>' . ($dish["comment"] ?? "") . '</p></div>';
    echo '</div></div>';
}
?>
<?php
foreach ($categories as $cat => $list) {
    echo '<div id="' . $cat . '" class="modal">';
    echo '<div class="modal_content modernNeonBox">';
    echo '<a href="#" class="modal_close">&times;</a>';
    echo '<h2 class="dish-title basic">' . strtoupper($cat) . '</h2>';
    echo '<ul class="liste">';
    foreach ($list as $dishId) {
        $title = $dishesById[$dishId]["title"] ?? "Unknown";
        echo '<li class="texte"><a href="#' . $dishId . '" class="link">' . $title . '</a></li>';
    }
echo '</ul></div></div>';
    }


?>
<?php include __DIR__ . '/footer.html'; ?>
</body>
</html>