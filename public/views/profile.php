<?php
require '../../private/php/session.php';
require '../../private/php/data_loader.php';
require '../../private/php/generate-nav.php';
require_login();
$user = get_user_by_session();

$email = $user["email"];
$firstName = $user["profile"]["firstName"];
$lastName = $user["profile"]["lastName"];
$fullName = $firstName . " " . $lastName;
$phone = $user["phone"];
$address = $user["profile"]["address"];
$fidelityPoints = $user["fidelity"];
$ordersHistory = getOrdersByEmail($email);

$analyticsCookiesChecked = $user['cookies']['analyticsCookies'] ?? false;
$functionalCookiesChecked = $user['cookies']['functionalCookies'] ?? false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css"/>
    <link rel="stylesheet" href="../styles/profile.css"/>
    <title>Profile</title>
</head>
<body>

  <?php include 'sidebar.php'; ?>

<section class="profile">

  <header class="profile-header">
    <div class="avatar"></div>
    <h1><?= $fullName ?></h1>
    <p class="email"><?= $email ?></p>
  </header>

  <section class="card modernNeonBox">
    <div class="card-header">
      <h2>Personal Information</h2>
    </div>

    <div class="info-row" data-field="firstName">
      <span>First Name</span>
      <span class="value">
        <?= $firstName ?>
        <button class="edit-btn">✏️</button>
      </span>
    </div>

    <div class="info-row" data-field="lastName">
      <span>Last Name</span>
      <span class="value">
        <?= $lastName ?>
        <button class="edit-btn">✏️</button>
      </span>
    </div>

    <div class="info-row" data-field="email">
      <span>Email</span>
      <span class="value">
        <?= $email ?>
        <button class="edit-btn">✏️</button>
      </span>
    </div>

    <div class="info-row" data-field="phone">
      <span>Phone</span>
      <span class="value">
        <?= $phone ?>
        <button class="edit-btn">✏️</button>
      </span>
    </div>

    <div class="info-row" data-field="address">
      <span>Address</span>
      <span class="value">
        <?= $address ?>
        <button class="edit-btn">✏️</button>
      </span>
    </div>
  </section>

  <section class="card modernNeonBox">
    <h2>My Orders</h2>

    <?php foreach($ordersHistory as $order):
    ?>

      <div class="order">
        <span><?= $order['id'] ?></span>
        <span><?= $order['date'] ?></span>
        <span><?= $order['price'] ?> $</span>
        <span class="status <?= $order['delivery']['status'] ?>"><?= $order['delivery']['status'] ?></span>
      </div>


    <?php endforeach ?>
  </section>

  <section class="card modernNeonBox">
    <h2>Loyalty</h2>

    <p><strong>Current Points:</strong> <?= $fidelityPoints ?> pts</p>
    <p><strong>Next Reward:</strong> €5 off at 150 pts</p>

    <div class="progress-bar">
      <div class="progress" style="width: <?php echo ($fidelityPoints / 150) * 100; ?>%;"></div>
    </div>
  </section>

  <section class="card modernNeonBox">
    <h2>Cookie Settings</h2>

    <p>You can manage your cookie preferences below.</p>

    <form class="cookie-settings" action="../../private/php/update_user_cookies.php" method="post">
      <label>
        <input
          type="checkbox"
          name="essentialCookies"
          disabled
          checked
        >
        Essential Cookies (Required)
      </label>

      <label>
        <input
        type="checkbox"
        name="analyticsCookies"
        <?php if ($analyticsCookiesChecked) echo 'checked'; ?>
      >
        Analytics Cookies
      </label>

      <label>
        <input
        type="checkbox"
        name="functionalCookies"
        <?php if ($functionalCookiesChecked) echo 'checked'; ?>
      >
        Functional Cookies
      </label>

      <button type="submit" class="btn-success">
        Save Preferences
      </button>
    </form>
  </section>

  <form action="logout.php">
    <input type="submit" value="Log out"/>
  </form>


</section>

</body>

<script defer type="module" src="../scripts/profile.js"></script>

</html>
