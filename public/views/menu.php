<?php
require '../../private/php/session.php';
$user = get_user_by_session();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <title>Menu</title>
    <script defer type="module" src="../scripts/menu-modal.js"></script>
    <script defer type="module" src="../scripts/menu.js"></script>
</head>
<body>
    <?php include 'cookiebanner.php'; ?>

    <?php include __DIR__ . '/header.html'; ?>

    <?php include __DIR__ . '/sidebar.php'; ?>

    <main>
        <?php include 'searchbar.php'; ?>
        <section class="search-results"></section>
        <section id="id" class="background-blur modal">
            <article class="modalContent modernNeonBox">
                <img src="../assets/images/default.png" class="background" alt="fork and knife default background">
                <div class="header">
                    <a href="#" class="modal_close">&times;</a>
                    <h2 class="dish-title">Title</h2>
                </div>
                <div class="description">
                    <p class="dish-version">Version</p>
                    <div class="dish-section">
                        <h3>Architecture</h3>
                        <ul>
                            <li>Information</li>
                        </ul>
                    </div>
                    <p class="dish-footer">Comment</p>
                </div>
                <div class="footer">
                    <div class="dish-section">
                        <h3>Price</h3>
                    </div>
                    <form method="POST" action="../views/panier.php">
                        <input type="hidden" name="item_id" value="id">
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="999">
                        <h3 class="hidden">Starter</h3>
                        <select name="starter" required disabled></select>
                        <h3 class="hidden">Main Course</h3>
                        <select name="main course" required disabled></select>
                        <h3 class="hidden">Drink</h3>
                        <select name="drink" required disabled></select>
                        <h3 class="hidden">Dessert</h3>
                        <select name="dessert" required disabled></select>
                        <button type="submit">Add to cart</button>
                    </form>
                </div>
            </article>
        </section>
    </main>

    <?php include __DIR__ . '/footer.html'; ?>

</body>
</html>
