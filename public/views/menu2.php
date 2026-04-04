<?php require '../../private/php/session.php';?>
<?php
$dataDishes = json_decode(file_get_contents("../data/dishes.json"), true);
$dataMenus  = json_decode(file_get_contents("../data/menus.json"), true);

include "../php/menu_creator.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="../styles/menu.css">
</head>

<body>

<h1>Restaurant Menu</h1>

<h2>Menus</h2>
<div class="cards-container">
<?php
foreach ($dataMenus["menus"] as $menu) {
    renderCard($menu["id"], $menu["name"], $menu["image"], $menu["price"]);
}
?>
</div>

<h2>Categories</h2>
<div class="cards-container">
<?php
$categories = [];

foreach ($dataDishes["dishes"] as $dish) {
    $categories[$dish["category"]] = true;
}

foreach (array_keys($categories) as $cat) {
    renderCard($cat, ucfirst($cat), "", "More info...", true);
}
?>
</div>

<?php
// MENU MODALS
foreach ($dataMenus["menus"] as $menu) {
    renderMenuModal($menu, $dataDishes);
}

// DISH MODALS
foreach ($dataDishes["dishes"] as $id => $dish) {
    renderDishModal($id, $dish);
}

// CATEGORY MODALS
foreach (array_keys($categories) as $cat) {
    renderCategoryModal($cat, $dataDishes);
}
?>

</body>
</html>