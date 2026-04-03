<?php
$dataDishes = json_decode(file_get_contents("../data/dishes.json"), true);
$dataMenus  = json_decode(file_get_contents("../data/menus.json"), true);
function renderCard($id, $title, $image, $price, $alt, $ariaLabel, $isBasic = false) {
    $basicClass = $isBasic ? "basic" : "";
    $btnClass = $isBasic ? "card-btn-basic" : "";
    echo '
    <article class="menu-card modernNeonBoxGlass ' . $basicClass . '" role="listitem" aria-label="' . $ariaLabel . '">
        ' . (!$isBasic ? '<img src="' . $image . '" class="menu-img" alt="' . $alt . '" />' : '') . '
        <h3>' . $title . '</h3>
        <a href="#' . $id . '" class="card-btn ' . $btnClass . '">' . $price . '</a>
    </article>';
}
function renderModal($id, $dish) {
    echo '
    <div id="' . $id . '" class="modal" role="dialog" aria-modal="true" aria-labelledby="' . $id . '-title">
        <div class="modal_content modernNeonBox">
            <a href="#" class="modal_close">&times;</a>
            <h2 class="dish-title" id="' . $id . '-title">' . $dish["name"] . '</h2>
            <img src="' . $dish["image"] . '" class="dish-img" alt="' . $dish["name"] . '"/>
            <p class="dish-version">' . $dish["version"] . '</p>';
    $sections = [
        "architecture" => "Architecture",
        "specifications" => "Spécifications",
        "security" => "Sécurité"
    ];
    foreach ($sections as $key => $title) {
        if (!empty($dish[$key])) {
            echo '<div class="dish-section"><h3>' . $title . '</h3><ul>';
            foreach ($dish[$key] as $item) {
                echo '<li>' . $item . '</li>';
            }
            echo '</ul></div>';
        }
    }
    if (!empty($dish["devnote"])) {
        echo '<div class="devnote">';
        if (is_array($dish["devnote"])) {
            echo '<ul>';
            foreach ($dish["devnote"] as $item) {
                echo '<li>' . $item . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>' . $dish["devnote"] . '</p>';
        }
        echo '</div>';
    }
    if (!empty($dish["footer"])) {
        echo '<div class="dish-footer">';
        if (is_array($dish["footer"])) {
            foreach ($dish["footer"] as $item) {
                echo '<p>' . $item . '</p>';
            }
        } else {
            echo '<p>' . $dish["footer"] . '</p>';
        }
        echo '</div>';
    }

    echo '</div></div>';
}

function renderMenuModal($menu, $dataDishes) {
    echo '
    <div id="' . $menu["id"] . '" class="modal" role="dialog">
        <div class="modal_content modernNeonBox">
            <a href="#" class="modal_close">&times;</a>
            <h2 class="dish-title">' . $menu["name"] . '</h2>
            <ul class="liste">';

    foreach ($menu["dishes"] as $dishId) {
        $dish = $dataDishes["dishes"][$dishId];

        echo '
        <li>
            <a href="#' . $dishId . '" class="link">
                ' . $dish["name"] . '
            </a>
        </li>';
    }
    echo '</ul></div></div>';
}
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