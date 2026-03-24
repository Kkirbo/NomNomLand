<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/Inscription.css">

</head>

<body>

  <?php include 'header.html'; ?>

  <?php include 'sidebar.php'; ?>

    <fieldset>
        <legend>Register</legend>

        <form action="https://www.cafe-it.fr/cytech/post.php" method="post">

            <div class="field">
                <label for="name">Name:</label>
                <input id="name" name="name" type="text" class="champ" required>
            </div>
            <div class="field">
                <label for="firstname">First name:</label>
                <input id="firstname" name="firstname" type="text" class="champ" required>
            </div>
            <div class="field">
                <label for="age">Age:</label>
                <input id="age" name="age" type="number" min="1" max="99" class="champ">
            </div>
            <div class="field">
                <label for="email">E-mail:</label>
                <input id="email" name="email" type="email" class="champ" required>
            </div>
            <div class="field">
                <label for="email-confirm">Confirm E-mail:</label>
                <input id="email-confirm" name="email-confirm" type="email" class="champ" required>
            </div>
            <div class="field">
                <label>Gender:</label>
                <input id="radio-male" type="radio" name="gender" value="male" checked>
                <label for="radio-male">Male</label>
                <input id="radio-female" type="radio" name="gender" value="female">
                <label for="radio-female">Female</label>
                <input id="radio-other" type="radio" name="gender" value="other">
                <label for="radio-other">Other</label>
                <input id="radio-unspecified" type="radio" name="gender" value="unspecified">
                <label for="radio-unspecified">Prefer not to say</label>
            </div>
            <div class="field">
                <label for="address">Address:</label>
                <input id="address" name="address" type="text"
                    pattern="^[0-9]+[ ]?[A-Za-zÀ-ÿ' -]+$"
                    placeholder="12 Rivoli Street Paris">
            </div>
            <div class="field">
                <label>Sign in</label>
                <button type="submit" class="button">
                    Submit
                </button>
                <br><br>
                <label>Reset form</label>
                <button type="reset" class="button" id="reset">
                    Reset form
                </button>
            </div>
        </form>
    </fieldset>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $firstName = $_POST['firstname'] ?? '';
    $lastName = $_POST['name'] ?? '';
    $username = strtolower($firstName . '.' . $lastName);
    $user = [
        "id" => time(),
        "login" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "role" => "client",
        "profile" =>[
            "firstName" =>$firstName,
            "lastName" =>$lastName,
            "username" =>$username
        ],
        "createdAt" => date("Y-m-d H:i:s"),
        "lastLogin" => null
    ];
    $file = "Register.json";
    if (file_exists($file)) {
        $users = json_decode(file_get_contents($file), true);
        $users=[];
    }

    // Ajout de l'utilisateur
    $users[] = $user;

    // Écriture dans le JSON
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
    <?php include 'footer.html'; ?>

</body>
</html>
