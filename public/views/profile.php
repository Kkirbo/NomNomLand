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

    <div class="info-row">
      <span>Last Name</span>
      <span><?= $fullName ?>
        <button class="edit-btn" title="Edit">✏️</button>
      </span>
    </div>

    <div class="info-row">
      <span>Email</span>
      <span>
        <?= $email ?>
        <button class="edit-btn" title="Edit">✏️</button>
    </span>
    </div>

    <div class="info-row">
      <span>Phone</span>
      <span>
        <?= $phone ?>
        <button class="edit-btn" title="Edit">✏️</button>
      </span>
    </div>

    <div class="info-row">
        <span>Address</span>
        <span>
        <?= $address ?>
        <button class="edit-btn" title="Edit">✏️</button>
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

    <button class="link-button">View All Orders</button>
  </section>

  <section class="card modernNeonBox">
    <h2>Loyalty</h2>

    <p><strong>Current Points:</strong> <?= $fidelityPoints ?> pts</p>
    <p><strong>Next Reward:</strong> €5 off at 150 pts</p>

    <div class="progress-bar">
      <div class="progress" style="width: <?php echo ($fidelityPoints / 150) * 100; ?>%;"></div>
    </div>

    <button class="link-button">View My Rewards</button>
  </section>

  <section class="card modernNeonBox">
    <h2>Cookie Settings</h2>

    <p>You can manage your cookie preferences below.</p>

    <form class="cookie-settings">
      <label>
        <input type="checkbox" checked disabled>
        Essential Cookies (Required)
      </label>

      <label>
        <input type="checkbox" name="analytics">
        Analytics Cookies
      </label>

      <label>
        <input type="checkbox" name="functional">
        Functional Cookies
      </label>

      <button type="submit" class="btn-success">
        Save Preferences
      </button>
    </form>
  </section>

  <button class="logout">Log Out</button>

</section>

</body>
</html>