<?php
$dataPath    = realpath(__DIR__ . '/../../private/data');
$dishesFile  = $dataPath . '/dishes.json';
$menusFile   = $dataPath . '/menus.json';

function getModalInfo($type, $id) {
    global $dishesFile, $menusFile;
    $items = [];
    if ($type === 'menu') {
        $info  = file_exists($menusFile) ? json_decode(file_get_contents($menusFile), true) : ["menus" => []];
        $items = $info['menus'];
    } elseif ($type === 'dish') {
        $info = file_exists($dishesFile) ? json_decode(file_get_contents($dishesFile), true) : ["dishes" => []];
        $items = $info['dishes'];
    }

    foreach ($items as $item) {
        if ($item['id'] === $id) return $item;
    }
    return null;
}
?>