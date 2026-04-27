<?php
function generateCard($id="", $image="../assets/images/default.png", $title="unknown", $description=[], $price=0)
{
    echo '<article class="menu modernNeonBoxGlass">';
    $href = (basename($_SERVER['PHP_SELF']) === 'menu.php' || basename($_SERVER['PHP_SELF']) === 'generate-search-result.php') ? '#' : 'menu.php#';
    echo '<a href="' . $href . htmlspecialchars($id) . '" class="imageLink">';
    echo '<img draggable="false" src="' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($title) . ' Image">';
    echo '</a>';
    echo '<h3>' . htmlspecialchars($title) . '</h3>';
    echo '<ul>';
    foreach ($description as $desc) {
        echo '<li>' . $desc . '</li>';
    }
    echo '</ul>';
    echo '<a href="' . $href . htmlspecialchars($id) . '"><button>' . htmlspecialchars($price) . '€</button></a>';
    echo '</article>';
}
?>