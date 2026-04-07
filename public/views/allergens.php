<?php
require '../../private/php/session.php';

$path = __DIR__ . "/../../private/data/dishes.json";
if (file_exists($path)) {
    $content = file_get_contents($path);
    $data = json_decode($content, true);

    if (!isset($data['dishes']) || !is_array($data['dishes'])) {
        $data['dishes'] = [];
    }
} else {
    $data = ["dishes" => []];
}

$dishes = $data['dishes'] ?? [];

$allergenMap = [
  "gluten" => "Gluten (wheat)",
  "milk" => "Milk",
  "eggs" => "Eggs",
  "soy" => "Soy",
  "nuts" => "Tree nuts",
  "fish" => "Fish",
  "crustaceans" => "Crustaceans",
  "celery" => "Celery",
  "mustard" => "Mustard",
  "sesame" => "Sesame",
  "sulphites" => "Sulphites"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allergens</title>

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
        <h1>Allergen Information</h1>

        <p>Last updated: March 2026</p>

        <p>
          At <strong>La Funzione</strong>, we take food safety seriously.
          Below you will find allergen information for our current menu items.
          Please inform our staff of any allergies before ordering.
        </p>

        <h2>EU Major Allergens Reference</h2>
        <p>
          The following allergens are identified in accordance with EU Regulation No. 1169/2011:
        </p>
        <ul>
          <li>Gluten</li>
          <li>Milk</li>
          <li>Eggs</li>
          <li>Soy</li>
          <li>Tree nuts</li>
          <li>Fish</li>
          <li>Crustaceans</li>
          <li>Celery</li>
          <li>Mustard</li>
          <li>Sesame</li>
          <li>Sulphites</li>
        </ul>

        <div>
          <table>
            <thead>
              <tr>
                <th>Dish</th>
                <th>Gluten (wheat)</th>
                <th>Milk</th>
                <th>Eggs</th>
                <th>Soy</th>
                <th>Tree nuts</th>
                <th>Fish</th>
                <th>Crustaceans</th>
                <th>Celery</th>
                <th>Mustard</th>
                <th>Sesame</th>
                <th>Sulphites</th>
              </tr>
            </thead>
            <tbody>
<?php foreach ($dishes as $dish): ?>

  <?php
    if (!isset($dish['allergens'])) continue;

    $dishAllergens = array_map('strtolower', $dish['allergens'] ?? []);
    $dishTrace = array_map('strtolower', $dish['trace'] ?? []);
  ?>

  <tr>
    <td><?= htmlspecialchars($dish['title']) ?></td>

    <?php foreach ($allergenMap as $key => $label): ?>
      <td>
        <?php if (in_array($key, $dishAllergens)): ?>
          <span class="contains">◉</span>
        <?php elseif (in_array($key, $dishTrace)): ?>
          <span class="trace">◐</span>
        <?php else: ?>
          <span class="none">—</span>
        <?php endif; ?>
      </td>
    <?php endforeach; ?>

  </tr>

<?php endforeach; ?>
</tbody>
            <!--<tbody>
              <tr>
                <td>Salade sans 5G</td>
                <td></td>
                <td></td>
                <td></td>
                <td><span class="trace">◐</span></td>
                <td><span class="trace">◐</span></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Calzone Container</td>
                <td><span class="contains">◉</span></td>
                <td><span class="contains">◉</span></td>
                <td></td>
                <td><span class="trace">◐</span></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Full Stack Lasagna // Beta-1.0</td>
                <td><span class="contains">◉</span></td>
                <td><span class="contains">◉</span></td>
                <td><span class="contains">◉</span></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><span class="contains">◉</span></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>NPC Margherita</td>
                <td><span class="contains">◉</span></td>
                <td><span class="contains">◉</span></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Penne.js Bolognese</td>
                <td><span class="contains">◉</span></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><span class="contains">◉</span></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Boolean Ravioli Open-Source</td>
                <td><span class="contains">◉</span></td>
                <td><span class="contains">◉</span></td>
                <td><span class="contains">◉</span></td>
                <td></td>
                <td><span class="trace">◐</span></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Callback Carbonara</td>
                <td><span class="contains">◉</span></td>
                <td><span class="contains">◉</span></td>
                <td><span class="contains">◉</span></td>
                <td><span class="trace">◐</span></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>Spaghetti Code</td>
                <td><span class="contains">◉</span></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>-->
          </table>
        </div>

        <p>
          <span class="contains">◉</span> Contains<br>
          <span class="trace">◐</span> May contain traces<br>
          <span class="none">—</span> Not present<br>
        </p>
        <h2>Important Notice</h2>
        <p>
          While we take strict precautions to prevent cross-contact,
          we cannot guarantee the complete absence of allergens due to
          shared kitchen environments.
        </p>
      </section>
    </main>

    <?php include 'footer.html'; ?>

</body>
</html>
