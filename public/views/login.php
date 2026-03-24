<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/Inscription.css">
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>

  <?php include '../php/header.html'; ?>

  <?php include '../php/sidebar.php'; ?>

    <main>
    <form action="https://www.cafe-it.fr/cytech/post.php" method="post">
        <fieldset>
            <div class="field">
                <label for="email">E-mail:</label>
                <input id="email" name="email" type="email" class="champ" placeholder="example@mail.com" required>
            </div>

            <div class="field">
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" class="champ" placeholder="abcdefg..." required>
            </div>

            <div class="buttons-container">
                <button type="submit" class="button">Login</button>
                <button type="reset" class="button">Reset</button>
            </div>

            <a class="signup-link" href="register.html">No account? Sign up</a>
        </fieldset>
    </form>
</main>


    <?php include '../php/footer.html'; ?>

</body>
</html>
