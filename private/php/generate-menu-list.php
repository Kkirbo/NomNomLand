<?php
function generateMenuList($count=0)
{
  $menus = json_decode(file_get_contents('../../private/data/menus.json'), true)['menus'];

  if ($count>0) $menus = array_slice($menus, 0, $count);

  foreach ($menus as $menu) {
      echo '<article class="menu modernNeonBoxGlass">';
      echo '<a href="menu.php#' . htmlspecialchars($menu['id']) . '" class="imageLink">';
      echo '<img draggable="false" src="' . htmlspecialchars($menu['image']) . '" alt="' . htmlspecialchars($menu['title']) . ' Image">';
      echo '</a>';
      echo '<h3>' . htmlspecialchars($menu['title']) . '</h3>';
      echo '<ul>';
      foreach ($menu['description'] as $desc) {
          echo '<li>' . htmlspecialchars($desc) . '</li>';
      }
      echo '</ul>';
      echo '<a href="menu.php#' . htmlspecialchars($menu['id']) . '"><button>' . htmlspecialchars($menu['price']) . '€</button></a>';
      echo '</article>';
  }
}
?>
