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
            <button type="button">Price ↓</button>
            <button type="button">Most bought ↓</button>
        </article>

        <h3>Filters</h3>
        <article>
            <label><input type="checkbox" name="starters">Starters</label>
            <label><input type="checkbox" name="maincourses">Main courses</label>
            <label><input type="checkbox" name="drinks">Drinks</label>
            <label><input type="checkbox" name="desserts">Desserts</label>
        </article>

        <article>
            <label><input type="checkbox" name="vegan">Vegan</label>
            <label><input type="checkbox" name="spice">Spice</label>
        </article>
        
        <h3>Allergens</h3>
        <article>
            <label><input type="checkbox" name="allergens[]" value="gluten"> Gluten</label>
            <label><input type="checkbox" name="allergens[]" value="milk"> Milk</label>
            <label><input type="checkbox" name="allergens[]" value="eggs"> Eggs</label>
            <label><input type="checkbox" name="allergens[]" value="soy"> Soy</label>
            <label><input type="checkbox" name="allergens[]" value="nuts"> Tree nuts</label>
            <label><input type="checkbox" name="allergens[]" value="fish"> Fish</label>
            <label><input type="checkbox" name="allergens[]" value="crustaceans"> Crustaceans</label>
            <label><input type="checkbox" name="allergens[]" value="celery"> Celery</label>
            <label><input type="checkbox" name="allergens[]" value="mustard"> Mustard</label>
            <label><input type="checkbox" name="allergens[]" value="sesame"> Sesame</label>
            <label><input type="checkbox" name="allergens[]" value="sulphites"> Sulphites</label>
        </article>
    </section>
</form>
