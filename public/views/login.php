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

  <?php include 'header.html'; ?>

  <?php include 'sidebar.php'; ?>

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

            <div class="buttons-container">
                <button type="submit" class="button">Login</button>
                <button type="reset" class="button">Reset</button>
            </div>

            <a class="signup-link" href="register.html">No account? Sign up</a>
        </fieldset>
    </form>
</main>
<?php


if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_verify($password, PASSWORD_DEFAULT);
}
$error=false;
$file = file_get_contents("../data/users.json");
$users = json_decode($file, true);
foreach ($users["users"]as $user) {
    if ($users==true && $user["email"] === $email && $user["password"] === $password) {
        $_SESSION["user"] = $user;
        $sstart= session_start();
        $_SESSION['timestamp'][]= $sstart;
        setcookie("user",$email, time() + 86400);
        header("../views/profile.php");
    }
    else {
    $error=true;
    }
}
?>
<?php if $error: ?>
    <p class="error-message">Invalid credentials. Please try again.</p>
    <?php include 'footer.html'; ?>
</body>
</html>
