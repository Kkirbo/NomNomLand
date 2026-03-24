<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <h2>Informations personnelles</h2>
    </div>

    <div class="info-row">
      <span>Nom</span>
      <span>Jean Dupont
        <button class="edit-btn" title="Modifier">✏️</button>
      </span>
    </div>

    <div class="info-row">
      <span>Email</span>
      <span>
        jean.dupont@email.com
        <button class="edit-btn" title="Modifier">✏️</button>
    </span>
    </div>

    <div class="info-row">
      <span>Téléphone</span>
      <span>
        06 45 78 21 39
        <button class="edit-btn" title="Modifier">✏️</button>
      </span>
    </div>

    <div class="info-row">
        <span>Adresse</span>
        <span>
        12 rue des Lilas, 75010 Paris
        <button class="edit-btn" title="Modifier">✏️</button>
        </span>
    </div>
  </section>

  <section class="card modernNeonBox">
    <h2>Mes commandes</h2>

    <div class="order">
      <span>#5482</span>
      <span>14 Jan 2026</span>
      <span>24,90 €</span>
      <span class="status delivered">Livrée</span>
    </div>

    <div class="order">
      <span>#5411</span>
      <span>03 Jan 2026</span>
      <span>18,50 €</span>
      <span class="status failed">Echoue</span>
    </div>

    <div class="order">
      <span>#5328</span>
      <span>22 Déc 2025</span>
      <span>31,20 €</span>
      <span class="status delivered">Livrée</span>
    </div>

    <button class="link-button">Voir toutes les commandes</button>
  </section>

  <section class="card modernNeonBox">
    <h2>Fidélité</h2>

    <p><strong>Points actuels :</strong> 120 pts</p>
    <p><strong>Prochaine récompense :</strong> -5€ à 150 pts</p>

    <div class="progress-bar">
      <div class="progress"></div>
    </div>

    <button class="link-button">Voir mes récompenses</button>
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

  <button class="logout">Se déconnecter</button>

</section>

</body>
</html>
