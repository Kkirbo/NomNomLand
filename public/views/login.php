<?php 
require '../../private/php/session.php';
include '../../private/php/login.php'; 

function retype($key) {
    return htmlspecialchars($_POST[$key] ?? '');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/form.css">
    <script defer src="../scripts/form.js"></script>
</head>
<body>
  <?php include 'header.html'; ?>
  <?php include 'sidebar.php'; ?>
  <main>
    <form method="post" onsubmit="return checkLogin()" novalidate>
        <fieldset>
            <div class="field">
                <label for="email">E-mail:</label>
                <input id="email" name="email" type="email" placeholder="example@email.com" required value="<?= retype('email') ?>">
            </div>

            <div class="field password-field">
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" placeholder="password" required>
                <button type="button" id="togglePassword" onclick="TogglePassword();">
  <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480h80q0 66 25 124.5t68.5 102q43.5 43.5 102 69T480-159q134 0 227-93t93-227q0-134-93-227t-227-93q-89 0-161.5 43.5T204-640h116v80H80v-240h80v80q55-73 138-116.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-80-240q-17 0-28.5-11.5T360-360v-120q0-17 11.5-28.5T400-520v-40q0-33 23.5-56.5T480-640q33 0 56.5 23.5T560-560v40q17 0 28.5 11.5T600-480v120q0 17-11.5 28.5T560-320H400Zm40-200h80v-40q0-17-11.5-28.5T480-600q-17 0-28.5 11.5T440-560v40Z"/></svg></button>
</div>
            <div class="field buttons">
              <div>
                <label>Sign in</label>
                <button type="submit" class="button">Submit</button>
              </div>
              <div>
                <label>Reset form</label>
                <button type="reset" class="button" id="reset">Reset</button>
              </div>
            </div>

            <?php $redirect = $_GET['redirect'] ?? null; ?>
            <a href="register.php<?= $redirect ? '?redirect=' . urlencode($redirect) : '' ?>">No account? Sign up</a>

            <?php
              if ($error!='') echo '<p class="error-message">' . htmlspecialchars($error) . '</p>';
            ?>
            
        </fieldset>
    </form>
  </main>

  <?php include 'footer.html'; ?>
</body>
</html>
