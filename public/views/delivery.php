<?php 
require '../../private/php/session.php';
require_once "../../private/php/utilities/data.php";
require_login();
$user = get_user_by_session();
if (!is_any_role($user, ["admin", "cook", "delivery"])) redirect_url();

$delivery_id = $user['id'];
$order = get_order_by_delivery_id($delivery_id);

if ($order) {
    $noOrder = false;
    $client = get_user_by_id($order["user_id"]) ?? null;
    $phone = $client["phone"] ?? null;
    $name = $client["profile"]["lastName"] . " " . $client["profile"]["firstName"] ?? null;
    $address = $order["delivery"]["address"] ?? null;
} else if (!is_role($user, "admin")) {//Admins can stay on page even if not working
    header("Location: orders.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery</title>
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/delivery.css">
</head>
<body>

  <?php include 'sidebar.php'; ?>

  <section class="infos modernNeonBoxGlass">

    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.991629987298!2d2.289610393129337!3d48.858369997414485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1771511294650!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
    
    <?php
    echo '<iframe 
      src="https://www.google.com/maps?q=<?=' . urlencode($address) . '?>&output=embed">
    </iframe>'
    ?>

    <label for="toggle" class="btn">Informations</label>

    <form action="../../private/php/update_delivery_status.php" method="post">
      <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
        <button type="submit" name="action" value="complete">
            Delivery complete
        </button>
    </form>

    <form action="../../private/php/update_delivery_status.php" method="post">
      <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
        <button type="submit" name="action" value="giveup">
            Give up delivery
        </button>
    </form>
  </section>

  <input type="checkbox" id="toggle" hidden>
  <section class="popup">
    <dl id="delivery-info" class="modernNeonBox">
      <dt>Address</dt>
      <dd><?= $address ?></dd>

      <dt>Contents</dt>
      <ul>
        <?php
        foreach($order["content"] as $item) {
          echo "<li>" . htmlspecialchars($item) . "</li>";
        }
        ?>
      </ul>

      <dt>Phone</dt>
      <dd>
          <?php
          echo '<a href="tel:+' . $phone . '">' . $phone . '</a>';
          ?>
      </dd>

      <dt>Open in Maps:</dt>
      <dd>
        <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($address) ?>" target="_blank">
          Open in Google Maps
        </a>
      </dd>

      <dt>Name</dt>
      <dd><?= $name ?></dd>

      <label for="toggle" class="close">Close</label>
    </dl>
  </section>

</body>
</html>
