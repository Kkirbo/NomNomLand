<?php
require_once "./session.php";
require_once "./data_loader.php";

$email = get_user_by_session()["email"];

$questions = ['q1', 'q2', 'q3', 'q4', 'q5'];

$ratingData = [];

foreach ($questions as $q) {
    $key = "rating-" . $q;

    if (isset($_POST[$key])) {
        $value = (int) $_POST[$key];

        if ($value >= 1 && $value <= 5) {
            $ratingData[$q] = $value;
        } else {
            $ratingData[$q] = null;
        }
    } else {
        $ratingData[$q] = null;
    }
}

$filePath = __DIR__ . '/../data/orders.json';

$json = file_get_contents($filePath);
$orders = json_decode($json, true);

$userOrders = array_filter($orders, function ($order) use ($email) {
    return isset($order['email']) && $order['email'] === $email;
});

usort($userOrders, function ($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

$latestOrder = $userOrders[0];
$latestOrderId = $latestOrder['id'];

foreach ($orders as &$order) {
    if (isset($order['id']) && $order['id'] === $latestOrderId) {

        if ($order["delivery"]["status"] != "success") {
            header("Location: ../../public/views/index.php");
            exit();
        }

        $order['rating'] = $ratingData;
        break;
    }
}
unset($order);

file_put_contents(
    $filePath,
    json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

header("Location: ../../public/views/index.php");
exit();

?>