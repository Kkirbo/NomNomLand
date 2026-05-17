<?php 
require '../../private/php/session.php';
include '../../private/php/register.php'; 

function retype($key) {
    return htmlspecialchars($_POST[$key] ?? '');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/form.css">
    <script defer type="module" src="../scripts/form.js"></script>
    <script>
      import { checkLogin, Autocorrect, CharLength, TogglePassword } from "../scripts/form.js";
    </script>
</head>

<body>

  <?php include 'header.html'; ?>

  <?php include 'sidebar.php'; ?>

  <main>
    <form method="post" onsubmit="return validateForm()" novalidate>
    <fieldset>

      <div class="field">
          <label for="name">Last Name:</label>
          <input id="name" class="champ" name="name" type="text"oninput="Autocorrect()" placeholder="Last Name" required value="<?= retype('name')  ?>">
        </div>
      <div class="field">
          <label for="firstname">First name:</label>
          <input id="firstname" class="champ" name="firstname" type="text"oninput="Autocorrect()" placeholder="First Name" required value="<?= retype('firstname') ?>">
      </div>
      <div class="field">
          <label for="age">Age:</label>
          <input id="age" name="age" type="number" min="18" max="120" placeholder="18" required value="<?= retype('age') ?>">
      </div>
      <div class="field">
          <label for="email">E-mail:</label>
          <input id="email" name="email" type="email" placeholder="example@email.com" required value="<?= retype('email') ?>">
      </div>
      <div class="field">
          <label for="phone">Phone number:</label>
          <input id="phone" name="phone" type="tel" placeholder="0011223344" required value="<?= retype('phone') ?>">
      </div>
            <div class="field password-field">
                <label for="password">Password:</label>
                <input id="password" maxlength="101" name="password" type="password" placeholder="password" oninput="CharLength()" required>
                <button type="button" id="togglePassword" onclick="TogglePassword();">
  <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480h80q0 66 25 124.5t68.5 102q43.5 43.5 102 69T480-159q134 0 227-93t93-227q0-134-93-227t-227-93q-89 0-161.5 43.5T204-640h116v80H80v-240h80v80q55-73 138-116.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-80-240q-17 0-28.5-11.5T360-360v-120q0-17 11.5-28.5T400-520v-40q0-33 23.5-56.5T480-640q33 0 56.5 23.5T560-560v40q17 0 28.5 11.5T600-480v120q0 17-11.5 28.5T560-320H400Zm40-200h80v-40q0-17-11.5-28.5T480-600q-17 0-28.5 11.5T440-560v40Z"/></svg></button>
                <span><span id="compteur">0</span>/100</span>
</div>
      <div class="field">
          <label>Gender:</label>
          <div class="radioInputs">
            <input id="radio-male" type="radio" name="gender" value="male" <?= retype('gender') === 'male' ? 'checked' : '' ?>>
            <label class="button" for="radio-male">Male</label>

            <input id="radio-female" type="radio" name="gender" value="female" <?= retype('gender') === 'female' ? 'checked' : '' ?>>
            <label class="button" for="radio-female">Female</label>

            <input id="radio-other" type="radio" name="gender" value="other" <?= retype('gender') === 'other' ? 'checked' : '' ?>>
            <label class="button" for="radio-other">Other</label>
          </div>
      </div>
      <div class="field">
          <label for="address">Address:</label>
          <input id="address" name="address" type="text" placeholder="12 Rivoli Street Paris" value="<?= retype('address') ?>">
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
      <a href="login.php<?= $redirect ? '?redirect=' . urlencode($redirect) : '' ?>">Already have an account? Sign in</a>

      <?php
        if ($error!='') echo '<p class="error-message">' . htmlspecialchars($error) . '</p>';
      ?>
    </fieldset>
  </form>
  </main>
  <?php include 'footer.html'; ?>

</body>
</html>
