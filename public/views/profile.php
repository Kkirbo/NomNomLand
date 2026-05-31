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
$password=$user["password"];
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
        <div>
  <span>Password</span>
  <div class="password-field">
    <input type="checkbox" id="togglePasswordProfile">
    <label for="togglePasswordProfile">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"fill="currentColor">
        <path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480h80q0 66 25 124.5t68.5 102q43.5 43.5 102 69T480-159q134 0 227-93t93-227q0-134-93-227t-227-93q-89 0-161.5 43.5T204-640h116v80H80v-240h80v80q55-73 138-116.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-80-240q-17 0-28.5-11.5T360-360v-120q0-17 11.5-28.5T400-520v-40q0-33 23.5-56.5T480-640q33 0 56.5 23.5T560-560v40q17 0 28.5 11.5T600-480v120q0 17-11.5 28.5T560-320H400Zm40-200h80v-40q0-17-11.5-28.5T480-600q-17 0-28.5 11.5T440-560v40Z"/>
      </svg>
    </label>
    <input
      id="password"
      maxlength="100"
      name="password"
      type="password"
      placeholder="New password"
      class="editable-password"
    >
  </div>
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
