<?php
$dataDishes = json_decode(file_get_contents("../data/meal.json"), true);
$dataMenus  = json_decode(file_get_contents("../data/menus.json"), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css"/>
    <link rel="stylesheet" href="../styles/menu.css"/>
    <title>Menu</title>
</head>

<body>

<?php include "../php/header.html"; ?>
<?php include "../php/sidebar.php"; ?>
<?php include "../../private/php/maenu_creator.php"; ?>

<h1 id="menuheader">Restaurant Menu</h1>
<div class="menu-left">
    <h2 id="sousmenuheader">Menus</h2>
    <div class="cards-container">
        <?php
        foreach ($dataMenus["menus"] as $menu) {
            renderCard(
                $menu["id"],
                $menu["name"],
                $menu["image"],
                $menu["price"],
                $menu["name"],
                $menu["description"]
            );
        }
        ?>
    </div>
    <h2>Others</h2>
    <div class="cards-container">

    <div class="cards-container">
        <?php
        renderCard("menuentrees", "Entries", "", "More info...", "", "", true);
        renderCard("menuplats", "Main meals", "", "More info...", "", "", true);
        renderCard("menudesserts", "Desserts", "", "More info...", "", "", true);
        renderCard("menudrinks", "Drinks", "", "More info...", "", "", true);
        ?>
    </div>

</div>

<a href="../views/index.html" class="return0">
    End of the menu: return 0; // Buon appetito
</a>

<?php
foreach ($dataMenus["menus"] as $menu) {
    renderMenuModal($menu, $dataDishes);
}
?>

<?php
foreach ($dataDishes["dishes"] as $id => $dish) {
    renderModal($id, $dish);
}
?>

<?php include "../php/footer.html"; ?>
</body>
</html>