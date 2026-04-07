<?php

require '../../private/php/session.php';
require_login();
$loggedInUser = get_user_by_session();

require_once "./data_loader.php";

$path = __DIR__ . "/../data/users.json";

if (file_exists($path)) {
    $content = file_get_contents($path);
    $data = json_decode($content, true);

    if (!isset($data['users']) || !is_array($data['users'])) {
        $data['users'] = [];
    }
} else {
    $data = ["users" => []];
}

$essentialCookies = true;
$analyticsCookies = isset($_POST['analyticsCookies']);
$functionalCookies = isset($_POST['functionalCookies']);

$found = false;
foreach ($data['users'] as &$user) {
    if ($user['id'] === $loggedInUser['id']) {
        $user['cookies'] = [
            "essentialCookies" => $essentialCookies,
            "analyticsCookies" => $analyticsCookies,
            "functionalCookies" => $functionalCookies
        ];
        $found = true;
        break;
    }
}

if (!$found) {
    $loggedInUser['cookies'] = [
        "essentialCookies" => $essentialCookies,
        "analyticsCookies" => $analyticsCookies,
        "functionalCookies" => $functionalCookies
    ];
    $data['users'][] = $loggedInUser;
}

$json = json_encode($data, JSON_PRETTY_PRINT);
if ($json === false) {
    die("JSON Error: " . json_last_error_msg());
}

if (file_put_contents($path, $json) === false) {
    die("Internal server error: could not save cookies.");
}

header("Location: ../../public/views/profile.php");
exit();

?>
