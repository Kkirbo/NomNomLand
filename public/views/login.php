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
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/form.css">
    <!--<link rel="stylesheet" href="../styles/login.css">-->
</head>
<body>

  <?php include 'header.html'; ?>

  <?php include 'sidebar.php'; ?>

  <main>
    <form method="post">
        <fieldset>
            <div class="field">
                <label for="email">E-mail:</label>
                <input id="email" name="email" type="email" placeholder="example@email.com" required value="<?= retype('email') ?>">
            </div>

            <div class="field">
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" placeholder="password" required>
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
