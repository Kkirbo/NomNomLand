<?php
require_once __DIR__ . "/utilities/data.php";
require '../../private/php/generate-card.php';
function generateMenuList($count=0)
{
  $menus = load_data("menus.json", "menus")['menus'];
  if ($count>0) $menus = array_slice($menus, 0, $count);

  foreach ($menus as $menu) {
    generateCard("menu", $menu['id'], $menu['image'], $menu['title'], $menu['description'], $menu['price']);
  }
}
?>
