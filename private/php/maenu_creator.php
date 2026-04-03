<?php

function renderCard($id, $title, $image, $price, $isBasic = false) {
    $basicClass = $isBasic ? "basic" : "";
    $btnClass = $isBasic ? "card-btn-basic" : "";

    echo '
    <article class="menu-card ' . $basicClass . '">
        ' . (!$isBasic ? '<img src="' . $image . '" class="menu-img">' : '') . '
        <h3>' . $title . '</h3>
        <a href="#' . $id . '" class="card-btn ' . $btnClass . '">' . $price . '</a>
    </article>';
}

function renderDishModal($id, $dish) {
    echo '
    <div id="' . $id . '" class="modal">
        <div class="modal_content">
            <a href="#" class="modal_close">&times;</a>

            <h2>' . $dish["name"] . '</h2>
            <img src="' . $dish["image"] . '" class="dish-img">
            <p>' . $dish["version"] . '</p>';

    $sections = ["architecture", "specifications", "security"];

    foreach ($sections as $section) {
        if (isset($dish[$section])) {
            echo '<h3>' . ucfirst($section) . '</h3><ul>';
            foreach ($dish[$section] as $item) {
                echo '<li>' . $item . '</li>';
            }
            echo '</ul>';
        }
    }

    if (isset($dish["footer"])) {
        echo '<p>' . $dish["footer"] . '</p>';
    }

    echo '</div></div>';
}

function renderMenuModal($menu, $dataDishes) {
    echo '
    <div id="' . $menu["id"] . '" class="modal">
        <div class="modal_content">
            <a href="#" class="modal_close">&times;</a>

            <h2>' . $menu["name"] . '</h2>
            <ul>';

    foreach ($menu["dishes"] as $dishId) {
        $dish = $dataDishes["dishes"][$dishId];
        echo '<li><a href="#' . $dishId . '">' . $dish["name"] . '</a></li>';
    }

    echo '</ul></div></div>';
}

function renderCategoryModal($category, $dataDishes) {
    echo '
    <div id="' . $category . '" class="modal">
        <div class="modal_content">
            <a href="#" class="modal_close">&times;</a>

            <h2>' . ucfirst($category) . '</h2>
            <ul>';

    foreach ($dataDishes["dishes"] as $id => $dish) {
        if ($dish["category"] === $category) {
            echo '<li><a href="#' . $id . '">' . $dish["name"] . '</a></li>';
        }
    }

    echo '</ul></div></div>';
}