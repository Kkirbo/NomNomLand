<?php require '../../private/php/session.php';?>
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
    <h1>Jean Dupont</h1>
    <p class="email">jean.dupont@email.com</p>
  </header>

  <section class="card modernNeonBox">
    <div class="card-header">
      <h2>Personal Information</h2>
    </div>

    <div class="info-row">
      <span>Last Name</span>
      <span>Jean Dupont
        <button class="edit-btn" title="Edit">✏️</button>
      </span>
    </div>

    <div class="info-row">
      <span>Email</span>
      <span>
        jean.dupont@email.com
        <button class="edit-btn" title="Edit">✏️</button>
    </span>
    </div>

    <div class="info-row">
      <span>Phone</span>
      <span>
        06 45 78 21 39
        <button class="edit-btn" title="Edit">✏️</button>
      </span>
    </div>

    <div class="info-row">
        <span>Address</span>
        <span>
        12 rue des Lilas, 75010 Paris
        <button class="edit-btn" title="Edit">✏️</button>
        </span>
    </div>
  </section>

  <section class="card modernNeonBox">
    <h2>My Orders</h2>

    <div class="order">
      <span>#5482</span>
      <span>Jan 14, 2026</span>
      <span>€24.90</span>
      <span class="status delivered">Delivered</span>
    </div>

    <div class="order">
      <span>#5411</span>
      <span>Jan 03, 2026</span>
      <span>€18.50</span>
      <span class="status failed">Failed</span>
    </div>

    <div class="order">
      <span>#5328</span>
      <span>Dec 22, 2025</span>
      <span>€31.20</span>
      <span class="status delivered">Delivered</span>
    </div>

    <button class="link-button">View All Orders</button>
  </section>

  <section class="card modernNeonBox">
    <h2>Loyalty</h2>

    <p><strong>Current Points:</strong> 120 pts</p>
    <p><strong>Next Reward:</strong> €5 off at 150 pts</p>

    <div class="progress-bar">
      <div class="progress"></div>
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