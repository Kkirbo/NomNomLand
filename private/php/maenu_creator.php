<?php
function renderCard($id, $title, $image, $price, $alt, $ariaLabel, $isBasic = false) {
    $basicClass = $isBasic ? "basic" = "";
    $btnClass = $isBasic ? "card-btn-basic" = "";
    echo '
    <article class="menu-card modernNeonBoxGlass ' . $basicClass . '" role="listitem" aria-label="' . $ariaLabel . '">
        ' . (!$isBasic ? '<img src="' . $image . '" class="menu-img" alt="' . $alt . '" />' : '') . '
        <h3>' . $title . '</h3>
        <a href="#' . $id . '" class="card-btn ' . $btnClass . '">' . $price . '</a>
    </article>';
}
/function renderModal($id, $dish) {
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
            echo '<div class="dish-section"><h3>' . $title . '</h3><ul>';
            foreach ($dish[$key] as $item) {
                echo '<li>' . $item . '</li>';
            }
            echo '</ul></div>';
        }
    }
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
        echo '<div class="dish-footer">';
        if (is_array($dish["footer"])) {
            foreach ($dish["footer"] as $item) {
                echo '<p>' . $item . '</p>';
            }
        } else {
            echo '<p>' . $dish["footer"] . '</p>';
        }
        echo '</div>';

    echo '</div></div>';
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
