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
          <label for="email-confirm">Password:</label>
          <input id="email-confirm" name="password" type="text" class="champ" required>
      </div>
      <div class="field">
          <label>Gender:</label>
          <input id="radio-male" type="radio" name="gender" value="male" checked>
          <label class="button" for="radio-male">Male</label>
          <input id="radio-female" type="radio" name="gender" value="female">
          <label class="button" for="radio-female">Female</label>
          <input id="radio-other" type="radio" name="gender" value="other">
          <label class="button" for="radio-other">Other</label>
          <input id="radio-unspecified" type="radio" name="gender" value="unspecified">
          <label class="button" for="radio-unspecified">Prefer not to say</label>
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
    </fieldset>
  </form>
  </main>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $firstName = $_POST['firstname'] ?? '';
    $lastName = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';
    $address = $_POST['address'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $username = $firstName . '.' . $lastName;

    $user = [
        "User" => [
            "id" => time(),
            "login" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "role" => "client",
            "profile" => [
                "firstName" => $firstName,
                "lastName" => $lastName,
                "username" => $username,
                "age" => $age,
                "address" => $address,
                "gender" => $gender
            ],
            "createdAt" => date("Y-m-d H:i:s"),
            "lastLogin" => null
        ]
    ];

    $file = __DIR__ . "/../data/Register.json";  //DIR is for the absolute path of the file
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $users = json_decode($content, true);
        if (!is_array($users)) $users = [];
    } else {
        $users = [];
    }
    $users[] = $user;
    $json = json_encode($users, JSON_PRETTY_PRINT);
    if ($json === false) {
        echo "Erreur JSON : " . json_last_error_msg();
    } else {
        $result = file_put_contents($file, $json);
        if ($result === false) echo "Impossible d'écrire dans Register.json !";
    }
}
?>

    <?php include 'footer.html'; ?>

</body>
</html>
