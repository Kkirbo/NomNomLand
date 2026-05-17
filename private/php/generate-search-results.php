<?php
require_once __DIR__ . "/utilities/data.php";
if (!isset($dishesData) || !isset($menusData)) {
    $dishesData = load_data("dishes.json", "dishes");
    $menusData = load_data("menus.json", "menus");
    $dishesById = [];
    foreach ($dishesData["dishes"] ?? [] as $dish) {
        $dishesById[$dish["id"]] = $dish;
    }
}

require_once __DIR__ . '/generate-card.php';
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$allergensFilter = $_GET['allergens'] ?? [];

$typeFilters = [
    'menu' => isset($_GET['menus']),
    'starter' => isset($_GET['starters']),
    'main course' => isset($_GET['maincourses']),
    'drink' => isset($_GET['drinks']),
    'dessert' => isset($_GET['desserts']),
];
$tagFilters = [
    'vegan' => isset($_GET['vegan']),
    'halal' => isset($_GET['halal']),
    'spice' => isset($_GET['spice']),
];
$activeTypes = array_keys(array_filter($typeFilters));

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
function matchesType($dish, $typeFilters) {
    $activeTypes = array_keys(array_filter($typeFilters));
    if (empty($activeTypes)) return true;

    $dishTags = $dish['tags'] ?? [];

    foreach ($activeTypes as $type) {
        if ($type === 'menu') continue;
        if (in_array($type, $dishTags)) {
            return true;
        }
    }
    return false;
}
function matchesTags($dish, $tagFilters) {
    $activeTags = array_keys(array_filter($tagFilters));
    if (empty($activeTags)) return true;

    $dishTags = $dish['tags'] ?? [];

    foreach ($activeTags as $tag) {
        if (!in_array($tag, $dishTags)) {
            return false;
        }
    }
    return true;
}
function matchesSearchDish($dish, $search) {
    if ($search === '') return true;

    $text = strtolower(
        ($dish['title'] ?? '') . ' ' .
        ($dish['comment'] ?? '')
    );

    return str_contains($text, $search);
}
function matchesSearchMenu($menu, $search) {
    if ($search === '') return true;

    $text = strtolower(
        ($menu['title'] ?? '') . ' ' .
        implode(' ', $menu['description'] ?? [])
    );

    return str_contains($text, $search);
}

//Filter Dishes
$filteredDishes = [];
foreach ($dishesData["dishes"] as $dish) {
    if (!matchesSearchDish($dish, $search) || !empty(allergensContained($dish, $allergensFilter)) || !matchesTags($dish, $tagFilters)) continue;

    if (!empty($activeTypes)) {
        if (count($activeTypes) === 1 && in_array('menu', $activeTypes)) {
            continue;
        }
        if (!matchesType($dish, $typeFilters)) continue;
    }

    $filteredDishes[] = $dish;
}

//Filter Menus
$filteredMenus = [];
foreach ($menusData["menus"] as $menu) {
    if ((!empty($activeTypes) && !in_array('menu', $activeTypes))) continue;
    $validMenu = matchesSearchMenu($menu, $search);
    foreach ($menu["contents"] as $dishId) {
        if ($validMenu) break;
        $dish = $dishesById[$dishId];
        if (!isset($dishesById[$dishId]) || !empty(allergensContained($dish, $allergensFilter)) || !matchesTags($dish, $tagFilters)) continue;

        if (!empty($activeTypes)) {
            $menuOnly = (count($activeTypes) === 1 && in_array('menu', $activeTypes));

            if (!$menuOnly && !matchesType($dish, $typeFilters)) continue;
        }
        if (matchesSearchDish($dish, $search)) $validMenu = true;
    }
    if ($validMenu) {
        $filteredMenus[] = $menu;
    }
}

//Render
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
        if (!isset($dishesById[$dishId])) continue;
        $allergensContained = allergensContained($dishesById[$dishId], $allergensFilter);
        if (empty($allergensContained)) continue;
        $containedAllergens = array_merge($containedAllergens, $allergensContained);
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
    $dishTypeAsArray = [];
    $dishTags = $dish['tags'] ?? [];
    foreach ([ 'menu', 'starter', 'main course', 'drink', 'dessert' ] as $type) {
        if ($type === 'menu') continue;
        if (in_array($type, $dishTags)) $dishTypeAsArray = [$type];
    }
    generateCard("dish", $dish['id'], $dish['image'], $dish['title'], $dishTypeAsArray, $dish['price']);
}
echo '</section>';
?>