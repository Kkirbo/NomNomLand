<?php
require '../../private/php/session.php';
require '../../private/php/generate-nav.php';
require_once "../../private/php/utilities/data.php";
require_login();
$user = get_user_by_session();

$id = $user["id"];
$email = $user["email"];
$firstName = $user["profile"]["firstName"];
$lastName = $user["profile"]["lastName"];
$fullName = $firstName . " " . $lastName;
$phone = $user["phone"];
$address = $user["profile"]["address"];
$fidelityPoints = $user["fidelity"];
$ordersHistory = get_orders_by_user_id($user['id']);

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
    <script defer type="module" src="../scripts/profile.js"></script>
</head>
<body>

  <?php include 'cookiebanner.php'; ?>

  <?php include 'sidebar.php'; ?>

  <header>
    <h1><?= $fullName ?></h1>
    <h2><?= $email ?></h2>
  </header>

  <main>

    <section class="infos">
      <h2>Personal Information</h2>

      <article class="modernNeonBoxGlass infos">
        <div>
          <span>First Name</span>
          <span data-id="<?=htmlspecialchars($id)?>" data-name="profile->firstName" class="editable-user-text-info"><?= htmlspecialchars($firstName) ?></span>
        </div>

        <div>
          <span>Last Name</span>
          <span data-id="<?=htmlspecialchars($id)?>" data-name="profile->lastName" class="editable-user-text-info"><?= htmlspecialchars($lastName) ?></span>
        </div>

        <div>
          <span>Email</span>
          <span data-id="<?=htmlspecialchars($id)?>" data-name="email" class="editable-user-text-info"><?= htmlspecialchars($email) ?></span>
        </div>

        <div>
          <span>Phone</span>
          <span data-id="<?=htmlspecialchars($id)?>" data-name="phone" class="editable-user-text-info"><?= htmlspecialchars($phone) ?></span>
        </div>

        <div>
          <span>Address</span>
          <span data-id="<?=htmlspecialchars($id)?>" data-name="profile->address" class="editable-user-text-info"><?= htmlspecialchars($address) ?></span>
        </div>
      </article>
    </section>

    <section class="infos">
        <h2>My Orders</h2>
        <article class="card modernNeonBoxGlass">
            <div class="ordersContainer modernNeonBoxGlass">
                <p>You have no past order.</p>
            </div>
            <a href="orders.php">View my Orders</a>
        </article>
    </section>

    <section class="infos">
      <h2>Loyalty</h2>

      <article class="modernNeonBoxGlass">
        <p><strong>Current Points:</strong> <?= $fidelityPoints ?> pts</p>
        <!--<p><strong>Next Reward:</strong> €5 off at 150 pts</p>

        <div class="progress-bar">
          <div class="progress" style="width: <?php echo ($fidelityPoints / 150) * 100; ?>%;"></div>
        </div>-->
      </article>
    </section>

    <section class="infos">
      <h2>Cookie Settings</h2>

      <article class="modernNeonBoxGlass">
        <p>You can manage your cookie preferences below. <br>For more information visit our <a href="cookies.php">cookies page</a>.</p>

        <form class="cookie-settings">
          <label>
            <input type="checkbox" name="essentialCookies" disabled checked >
            Essential Cookies (Required)
          </label>

          <label>
            <input type="checkbox" name="analyticsCookies" <?php if ($analyticsCookiesChecked) echo 'checked'; ?> >
            Analytics Cookies
          </label>

          <label>
            <input type="checkbox" name="functionalCookies" <?php if ($functionalCookiesChecked) echo 'checked'; ?> >
            Functional Cookies
          </label>

          <button type="submit" class="btn-success">
            Save Preferences
          </button>
        </form>
      </article>
    </section>
  </main>

  <?php include 'footer.html'; ?>

</body>

</html>
