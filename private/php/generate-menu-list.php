<?php
require '../../private/php/generate-card.php';
function generateMenuList($count=0)
{
  $menus = json_decode(file_get_contents('../../private/data/menus.json'), true)['menus'];

  if ($count>0) $menus = array_slice($menus, 0, $count);

  foreach ($menus as $menu) {
    generateCard($menu['id'], $menu['image'], $menu['title'], $menu['description'], $menu['price']);
  }
}
?>
