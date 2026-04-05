<?php
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$allergensFilter = $_GET['allergens'] ?? [];
if ($search == '' && empty($allergensFilter)) return;

function allergensContained($dish, $allergensFilter) {
    $allergensContained = [];
    if (empty($allergensFilter)) return [];
    $dishAllergens = $dish['allergens'] ?? [];

    foreach ($allergensFilter as $allergen) {
        if (in_array($allergen, $dishAllergens)) {
            $allergensContained[] = $allergen;
        }
    }
    return $allergensContained;
}

$filteredDishes = [];
foreach ($dishesData["dishes"] as $dish) {
    if ($search !== '' && !str_contains(strtolower(json_encode($dish)), $search)) continue;
    if (!empty(allergensContained($dish, $allergensFilter))) continue;
    $filteredDishes[] = $dish;
}

$filteredMenus = [];
foreach ($menusData["menus"] as $menu) {
    if (str_contains(strtolower(json_encode($menu)), $search)) {
        $filteredMenus[] = $menu;
    }
}

echo "<h2>Search results for: " . htmlspecialchars($search) . "</h2>";

if (empty($filteredMenus) && empty($filteredDishes)) {
    echo "<p>No results found.</p>";
    return;
}
if (!empty($filteredMenus)) echo "<h2>Menus</h2>";
echo '<div class="cards-container">';
foreach ($filteredMenus as $menu) {
    $containedAllergens = [];
    $menuDishIds = array_merge($menu["dishes"] ?? [], $menu["desserts"] ?? [], $menu["drinks"] ?? []);
    foreach ($menuDishIds as $dishId) {
        if (isset($dishesById[$dishId])) {
            $allergensContained = allergensContained($dishesById[$dishId], $allergensFilter);
            if (empty($allergensContained)) continue;
            $containedAllergens = array_merge($containedAllergens, $allergensContained);
        }
    }
    $containedAllergens = array_unique($containedAllergens);
    echo '<article class="menu-card modernNeonBoxGlass">';
    echo '<img src="' . $menu["image"] . '" class="menu-img">';
    echo '<h3>' . $menu["title"] . '</h3>';
    if (!empty($containedAllergens)) {
        echo '<span class="pastel-orange">⚠ ' . implode(', ', $containedAllergens) . '</span>';
    }
    echo '<a href="#' . $menu["id"] . '" class="card-btn">' . $menu["price"] . '€</a>';
    echo '</article>';
}
echo '</div>';
if (!empty($filteredDishes)) echo "<h2>Dishes</h2>";
echo '<div class="cards-container">';
foreach ($filteredDishes as $dish) {
    echo '<article class="menu-card modernNeonBoxGlass">';
    echo '<img src="' . $dish["image"] . '" class="menu-img">';
    echo '<h3>' . $dish["title"] . '</h3>';
    echo '<a href="#' . $dish["id"] . '" class="card-btn">' . $dish["price"] . '€</a>';
    echo '</article>';
}
echo '</div>';
?>