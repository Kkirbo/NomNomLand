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
    <script defer src="../scripts/form.js"></script>
</head>

<body>

  <?php include 'header.html'; ?>

  <?php include 'sidebar.php'; ?>

  <main>
    <form method="post" onsubmit="return validateForm()" novalidate>
    <fieldset>

      <div class="field">
          <label for="name">Last Name:</label>
          <input id="name" name="name" type="text" placeholder="Last Name" required value="<?= retype('name') ?>">
      </div>
      <div class="field">
          <label for="firstname">First name:</label>
          <input id="firstname" name="firstname" type="text" placeholder="First Name" required value="<?= retype('firstname') ?>">
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
          <input id="phone" name="phone" type="tel" placeholder="001122334455" required value="<?= retype('phone') ?>">
      </div>
      <div class="field">
          <label for="password">Password:</label>
          <input id="password" name="password" type="password" placeholder="password" required>
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
