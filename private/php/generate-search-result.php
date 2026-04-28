<?php
if (!isset($dishesData) || !isset($menusData)) {
    $dataPath    = realpath(__DIR__ . '/../../private/data');
    $dishesFile  = $dataPath . '/dishes.json';
    $menusFile   = $dataPath . '/menus.json';
    $dishesData = file_exists($dishesFile) ? json_decode(file_get_contents($dishesFile), true) : ["dishes" => []];
    $menusData  = file_exists($menusFile) ? json_decode(file_get_contents($menusFile), true) : ["menus" => []];
    $dishesById = [];
    foreach ($dishesData["dishes"] ?? [] as $dish) {
        $dishesById[$dish["id"]] = $dish;
    }
}

require '../../private/php/generate-card.php';
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$allergensFilter = $_GET['allergens'] ?? [];
//if ($search == '' && empty($allergensFilter)) return;

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
    $validMenu = false;
    foreach ($menu["contents"] as $dishId) {
        if (isset($dishesById[$dishId])) {
            $allergensContained = allergensContained($dishesById[$dishId], $allergensFilter);
            if (empty($allergensContained)) {
                $validMenu = true;
                break;
            }
        }
    }
    if ($validMenu && str_contains(strtolower(json_encode($menu)), $search)) {
        $filteredMenus[] = $menu;
    }
}

if ($search != '') echo "<h2>Search results for: " . htmlspecialchars($search) . "</h2>";

if (empty($filteredMenus) && empty($filteredDishes)) {
    echo "<p>No results found.</p>";
    return;
}
if (!empty($filteredMenus)) echo "<h2 class=\"search-result\">Menus</h2>";
echo '<section class="menus">';
foreach ($filteredMenus as $menu) {
    $containedAllergens = [];
    foreach ($menu["contents"] as $dishId) {
        if (isset($dishesById[$dishId])) {
            $allergensContained = allergensContained($dishesById[$dishId], $allergensFilter);
            if (empty($allergensContained)) continue;
            $containedAllergens = array_merge($containedAllergens, $allergensContained);
        }
    }
    $containedAllergens = array_unique($containedAllergens);
    $description = $menu['description'];
    if (!empty($containedAllergens)) {
        array_push($description, '<span class="pastel-orange">⚠ ' . implode(', ', $containedAllergens) . '</span>');
    }
    generateCard("menu", $menu['id'], $menu['image'], $menu['title'], $description, $menu['price']);
}
echo '</section>';
if (!empty($filteredDishes)) echo "<h2 class=\"search-result\">Dishes</h2>";
echo '<section class="menus">';
foreach ($filteredDishes as $dish) {
    generateCard("dish", $dish['id'], $dish['image'], $dish['title'], [], $dish['price']);
}
echo '</section>';
?>