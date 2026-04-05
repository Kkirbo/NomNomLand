<?php


require_once "./data_loader.php";

$users = getUsers();

$userId = $_POST['userId'] ?? null;
$essentialCookies = $_POST['essentialCookies'] ?? null;
$essentialCookies = true;
$analyticsCookies = $_POST['analyticsCookies'] ?? null;
$functionalCookies = $_POST['functionalCookies'] ?? null;


foreach($users as &$user){

    if ($user["id"] === $userId) {
        
        $user["cookies"] = array(
            "essentialCookies" => $essentialCookies == 'on',
            "analyticsCookies" => $analyticsCookies == 'on',
            "functionalCookies" => $functionalCookies == 'on'
        );

        break;
    }
}

unset($user);

$users = array(
    "users" => $users
);

file_put_contents("../../private/data/users.json", json_encode($users, JSON_PRETTY_PRINT));

header("Location: ../../public/views/profile.php");
exit();

?>