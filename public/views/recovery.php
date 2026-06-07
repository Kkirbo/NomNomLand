<?php
require '../../private/php/session.php';
require_once '../../private/php/utilities/data.php';

$user = get_user_by_session();
if (!$user) logout();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"] ?? '';
    $confirmPassword = $_POST["confirmPassword"] ?? '';
    if ($password === $confirmPassword) {
        update_user_field($user['id'],'password',password_hash($password, PASSWORD_DEFAULT));
        logout();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recovery</title>
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/form.css">
    <script defer type="module" src="../scripts/form.js"></script>
</head>

<body>
<?php include 'header.html'; ?>
<?php include 'sidebar.php'; ?>
<main>
<form id="recoveryForm" method="post" novalidate class="validateForm modernNeonBox">
    <div class="field">
          <label for="password">Password:</label>
          <div class="password-field">
            <input type="checkbox" name="togglePassword" id="togglePassword">
            <label for="togglePassword">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480h80q0 66 25 124.5t68.5 102q43.5 43.5 102 69T480-159q134 0 227-93t93-227q0-134-93-227t-227-93q-89 0-161.5 43.5T204-640h116v80H80v-240h80v80q55-73 138-116.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-80-240q-17 0-28.5-11.5T360-360v-120q0-17 11.5-28.5T400-520v-40q0-33 23.5-56.5T480-640q33 0 56.5 23.5T560-560v40q17 0 28.5 11.5T600-480v120q0 17-11.5 28.5T560-320H400Zm40-200h80v-40q0-17-11.5-28.5T480-600q-17 0-28.5 11.5T440-560v40Z"/></svg>
            </label>
            <span class="valueLength"><span>0</span>/100</span>
            <input id="password" maxlength="100" name="password" type="password" placeholder="Password" required>
          </div>
      </div>

         <div class="field">
          <label for="passwordPassword">Confirm password:</label>
          <div class="password-field">
            <input type="checkbox" name="togglePassword" id="togglePassword2">
            <label for="togglePassword2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480h80q0 66 25 124.5t68.5 102q43.5 43.5 102 69T480-159q134 0 227-93t93-227q0-134-93-227t-227-93q-89 0-161.5 43.5T204-640h116v80H80v-240h80v80q55-73 138-116.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-80-240q-17 0-28.5-11.5T360-360v-120q0-17 11.5-28.5T400-520v-40q0-33 23.5-56.5T480-640q33 0 56.5 23.5T560-560v40q17 0 28.5 11.5T600-480v120q0 17-11.5 28.5T560-320H400Zm40-200h80v-40q0-17-11.5-28.5T480-600q-17 0-28.5 11.5T440-560v40Z"/></svg>
            </label>
            <span class="valueLength"><span>0</span>/100</span>
            <input id="confirmPassword" maxlength="100" name="confirmPassword" type="password" placeholder="Confirm password" required>
          </div>

    <button type="submit" class="button">Reset</button>

</form>

</main>

<?php include 'footer.html'; ?>

</body>
</html>