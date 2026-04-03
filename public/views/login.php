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

  <?php include '../../private/php/login.php'; ?>

    <main>
      <form method="post">
          <fieldset>
              <div class="field">
                  <label for="email">E-mail:</label>
                  <input id="email" name="email" type="email" class="champ" placeholder="example@mail.com" required>
              </div>

              <div class="field">
                  <label for="password">Password:</label>
                  <input id="password" name="password" type="password" class="champ" placeholder="abcdefg..." required>
              </div>

              <?php
                if ($error==true) echo"<p class=error-message>Invalid credentials. Please try again.</p>";
              ?>

              <div class="buttons-container">
                  <button type="submit" name="Submit" class="button">Login</button>
                  <button type="reset" class="button">Reset</button>
              </div>

              <a class="signup-link" href="register.html">No account? Sign up</a>
          </fieldset>
      </form>
    </main>

    <?php include 'footer.html'; ?>
</body>
</html>
