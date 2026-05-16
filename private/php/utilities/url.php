<?php
function getUrlRoot() {
    // "/public/views/page.php" -> "/public/views"
    // "/" -> ""
    return rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
}

//Redirects the user based on the redirect parameter of the url (useful for going back to a page after login)
function redirect_url($default="/index.php") {
    $redirect = $_GET['redirect'] ?? $default;
    if (!is_string($redirect)) $redirect = $default;
    
    $redirect = getUrlRoot() . '/' . ltrim($redirect, '/');
    header("Location: " . $redirect);
    exit();
}
?>