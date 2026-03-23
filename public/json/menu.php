<?php
$dishes = json_decode(file_get_contents(__DIR__ . "/../data/dishes.json"), true);
$menus = json_decode(file_get_contents(__DIR__ . "/../data/menu.json"), true);
?>

<?php if ($dishes && isset($dishes["dishes"])): ?>
    <?php foreach ($dishes["dishes"] as $dish): ?>
        <h3><?= htmlspecialchars($dish["name"]) ?></h3>
    <?php endforeach; ?>
<?php endif; ?>

<?php if ($menus && isset($menus["menus"])): ?>
    <?php foreach ($menus["menus"] as $menu): ?>
        <h2><?= htmlspecialchars($menu["name"]) ?></h2>
        <p><?= htmlspecialchars($menu["description"]) ?></p>
        <ul>
            <?php foreach ($menu["dishes"] as $dishId): ?>
                <?php
                foreach ($dishes["dishes"] as $dish) {
                    if ($dish["id"] == $dishId) {
                        echo "<li>" . htmlspecialchars($dish["name"]) . "</li>";
                    }
                }
                ?>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
<?php else: ?>
    <p>Erreur chargement menu.json</p>
<?php endif; ?>