<?php require '../../private/php/session.php';?>
<?php include '../../private/php/register.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/form.css">
    <!--<link rel="stylesheet" href="../styles/register.css">-->

</head>

<body>

  <?php include 'header.html'; ?>

  <?php include 'sidebar.php'; ?>

  <main>
    <form method="post">
    <fieldset>

      <div class="field">
          <label for="name">Last Name:</label>
          <input id="name" name="name" type="text" placeholder="Last Name" required>
      </div>
      <div class="field">
          <label for="firstname">First name:</label>
          <input id="firstname" name="firstname" type="text" placeholder="First Name" required>
      </div>
      <div class="field">
          <label for="age">Age:</label>
          <input id="age" name="age" type="number" min="18" max="120" placeholder="18">
      </div>
      <div class="field">
          <label for="email">E-mail:</label>
          <input id="email" name="email" type="email" placeholder="example@email.com" required>
      </div>
      <div class="field">
          <label for="email-confirm">Password:</label>
          <input id="email-confirm" name="password" type="password" placeholder="password" required>
      </div>
      <div class="field">
          <label>Gender:</label>
          <div class="radioInputs">
            <input id="radio-male" type="radio" name="gender" value="male" checked>
            <label class="button" for="radio-male">Male</label>
            <input id="radio-female" type="radio" name="gender" value="female">
            <label class="button" for="radio-female">Female</label>
            <input id="radio-other" type="radio" name="gender" value="other">
            <label class="button" for="radio-other">Other</label>
          </div>
      </div>
      <div class="field">
          <label for="address">Address:</label>
          <input id="address" name="address" type="text"
              pattern="^[0-9]+[ ]?[A-Za-zÀ-ÿ' -]+$"
              placeholder="12 Rivoli Street Paris">
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

      <?php
        if ($error!='') echo"<p class=error-message>" . $error . "</p>";
      ?>
    </fieldset>
  </form>
  </main>
  <?php include 'footer.html'; ?>

</body>
</html>
