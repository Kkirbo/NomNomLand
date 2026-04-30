<link rel="stylesheet" href="../styles/searchbar.css">
<script defer type="module" src="../scripts/searchbar.js"></script>
<form action="menu.php" method="get" class="searchbar" autocomplete="off">
    <section>
        <span>$ls</span>
        <input type="text" name="search" placeholder="Search for your favorite meal..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    </section>
    <button type="button" class="tune">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M440-120v-240h80v80h320v80H520v80h-80Zm-320-80v-80h240v80H120Zm160-160v-80H120v-80h160v-80h80v240h-80Zm160-80v-80h400v80H440Zm160-160v-240h80v80h160v80H680v80h-80Zm-480-80v-80h400v80H120Z"/></svg>
    </button>
    <section class="dropdown">
        <article>
            <button type="button" <?= (!isset($_GET['sort']) || (isset($_GET['sort']) && $_GET['sort'] == "alphabetical")) ? 'class="active"' : '' ?>>alphabetical ↓</button>
            <button type="button" <?= (isset($_GET['sort']) && $_GET['sort'] == "price") ? 'class="active"' : '' ?>>price ↓</button>
            <button type="button" <?= (isset($_GET['sort']) && $_GET['sort'] == "type") ? 'class="active"' : '' ?>>type ↓</button>
        </article>

        <h3>Filters</h3>
        <article>
            <label><input type="checkbox" name="menus" <?= isset($_GET['menus']) ? 'checked' : '' ?>>Menus</label>    
            <label><input type="checkbox" name="starters" <?= isset($_GET['starters']) ? 'checked' : '' ?>>Starters</label>
            <label><input type="checkbox" name="maincourses" <?= isset($_GET['maincourses']) ? 'checked' : '' ?>>Main courses</label>
            <label><input type="checkbox" name="drinks" <?= isset($_GET['drinks']) ? 'checked' : '' ?>>Drinks</label>
            <label><input type="checkbox" name="desserts" <?= isset($_GET['desserts']) ? 'checked' : '' ?>>Desserts</label>
        </article>

        <article>
            <label><input type="checkbox" name="vegan" <?= isset($_GET['vegan']) ? 'checked' : '' ?>>Vegan</label>
            <label><input type="checkbox" name="halal" <?= isset($_GET['halal']) ? 'checked' : '' ?>>Halal</label>
            <label><input type="checkbox" name="spice" <?= isset($_GET['spice']) ? 'checked' : '' ?>>Spice</label>
        </article>
        
        <h3>Allergens</h3>
        <article>
            <?php
            $allergens = ['gluten', 'milk', 'eggs', 'soy', 'nuts', 'fish', 'crustaceans', 'celery', 'mustard', 'sesame', 'sulphites'];
            foreach ($allergens as $allergen) {
                $checked = isset($_GET['allergens']) && in_array($allergen, $_GET['allergens']) ? 'checked' : '';
                echo "<label><input type=\"checkbox\" name=\"allergens[]\" value=\"$allergen\" $checked> " . ucfirst($allergen) . "</label>";
            }
            ?>
        </article>
    </section>
</form>
