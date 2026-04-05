<?php
require '../../private/php/session.php';
$error = '';
include '../../private/php/newsletter.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter</title>

    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/textpage.css">
    <script defer src="../scripts/index.js"></script>
</head>
<body>
    <canvas class="background"></canvas>

    <?php include 'header.html'; ?>

    <?php include 'sidebar.php'; ?>

    <main>
      <section class="modernNeonBoxGlass">
        <h1>Newsletter</h1>
        <form method="post" action="" id="newsletter">
          <input type="email" name="email" placeholder="Enter e-mail address" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          <input type="submit" value="Subscribe">
        </form>
        <?php
          if ($error!='') echo '<p class="error-message">' . htmlspecialchars($error) . '</p>';
          else if ($_SERVER['REQUEST_METHOD'] === 'POST') echo '
              <p>
                Thank you for subscribing to our newsletter.
              </p>
          ';
        ?>

        <h2>Wishing you a great time with La Funzione</h2>
        <p>
          If you have any questions feel free to contact us at
          <a href="mailto:careers@lafunzione.food">careers@lafunzione.food</a>.
        </p>
      </section>
    </main>

    <?php include 'footer.html'; ?>

</body>
</html>
