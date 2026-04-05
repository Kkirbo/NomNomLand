<script defer src="../scripts/searchbar.js"></script>
<form action="menusearch.php" method="get" class="searchbar" autocomplete="off">
    <div>
        <span>$ls</span>
        <input type="text" name="search" placeholder="Search for your favorite meal..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    </div>
    <details>
        <summary>Allergens</summary>
        <label class="tag">
            <input type="checkbox" name="allergens[]" value="gluten">
            <span>Gluten</span>
        </label>

        <label class="tag">
            <input type="checkbox" name="allergens[]" value="milk">
            <span>Milk</span>
        </label>
        <label><input type="checkbox" name="allergens[]" value="eggs"> Eggs</label>
        <label><input type="checkbox" name="allergens[]" value="soy"> Soy</label>
        <label><input type="checkbox" name="allergens[]" value="nuts"> Tree nuts</label>
        <label><input type="checkbox" name="allergens[]" value="fish"> Fish</label>
        <label><input type="checkbox" name="allergens[]" value="crustaceans"> Crustaceans</label>
        <label><input type="checkbox" name="allergens[]" value="celery"> Celery</label>
        <label><input type="checkbox" name="allergens[]" value="mustard"> Mustard</label>
        <label><input type="checkbox" name="allergens[]" value="sesame"> Sesame</label>
        <label><input type="checkbox" name="allergens[]" value="sulphites"> Sulphites</label>
    </details>
</form>