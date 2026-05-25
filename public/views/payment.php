<?php 
require '../../private/php/session.php';
require_once '../../private/php/utilities/data.php';
require_login();
$user = get_user_by_session();

$error = '';

$isReturn = isset($_GET['bank_return']) && $_GET['bank_return'] == 1;
$orderId = $_GET['order_id'] ?? null;

$order = get_user_last_order($user['id']);
require '../../private/php/getapikey.php';

if ($order && is_user_last_order_unpaid($user['id'])) {
  $transaction = $order['id'];
  $amount = number_format($order['price'], 2, '.', '');
  $vendor = "MI-4_C";//Our group (MI-4_K) isn't valid
  $api_key = getAPIKey($vendor);
  $return = "http://localhost:8080/public/views/payment.php?bank_return=1&order_id=" . urlencode($order['id']);
  $control = md5(
      $api_key . "#" .
      $transaction . "#" .
      $amount . "#" .
      $vendor . "#" .
      $return . "#"
  );

  if ($isReturn && $orderId) {
    $status = $_GET['status'] ?? '';
    $transaction = $_GET['transaction'] ?? '';
    $amount = $_GET['montant'] ?? '';
    $vendor = $_GET['vendeur'] ?? '';
    $controlCheck = $_GET['control'] ?? '';
    $api_key = getAPIKey($vendor);
    $control = md5(
        $api_key . "#" .
        $transaction . "#" .
        $amount . "#" .
        $vendor . "#" .
        $status . "#"
    );

    if ($status === 'accepted' && $controlCheck === $control) {
        $message = "Payment successful";
        update_order_field($orderId, "paymentStatus", "success");
    } else {
        $message = "Payment failed";
        update_order_field($orderId, "paymentStatus", "failed");
    }
  }
}

/*
Cardholder: Any
Card Number: 5555 1234 5678 9000
Crypto: 555
Expiry Date: Any
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/form.css">
    <link rel="stylesheet" href="../styles/order-preview.css">
    <script defer type="module" src="../scripts/display-latest-order.js"></script>
</head>
<body>
  <?php include 'cookiebanner.php'; ?>

  <?php include 'header.html'; ?>

  <?php include 'sidebar.php'; ?>

  <main>
    <section class="infos">
        <h2>Confirm your payment</h2>
        <article class="modernNeonBoxGlass">
            <?php if ($isReturn): ?>
                <h3><?= htmlspecialchars($message ?? "Payment processed") ?></h3>
                <a href="cart.php">Back to cart</a>
            <?php elseif (!is_user_last_order_unpaid($user['id'])): ?>
                <h3>You have no unpaid order.</h3>
                <a href="cart.php">Back to cart</a>
            <?php else: ?>
                <div class="ordersContainer modernNeonBoxGlass">
                    <p>You have no past order.</p>
                </div>
                <form method="post" action="https://www.plateforme-smc.fr/cybank/">
                    <input type="hidden" name="transaction" value="<?= htmlspecialchars($transaction) ?>">
                    <input type="hidden" name="montant" value="<?= htmlspecialchars($amount) ?>">
                    <input type="hidden" name="vendeur" value="<?= htmlspecialchars($vendor) ?>">
                    <input type="hidden" name="retour" value="<?= htmlspecialchars($return) ?>">
                    <input type="hidden" name="control" value="<?= htmlspecialchars($control) ?>">

                    <div class="buttons">
                        <label>Proceed to payment</label>
                        <button type="submit" class="button">Pay now</button>
                    </div>

                    <?php
                        if ($error!='') echo '<p class="error-message">' . htmlspecialchars($error) . '</p>';
                    ?>
                </form>
            <?php endif; ?>
        </article>
    </section>
  </main>

  <?php include 'footer.html'; ?>
</body>
</html>
