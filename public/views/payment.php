<?php 
require '../../private/php/session.php';
require_login();
$user = get_user_by_session();

$error = '';

$isReturn = isset($_GET['bank_return']) && $_GET['bank_return'] == 1;
$orderId = $_GET['order_id'] ?? null;

require '../../private/php/payment.php';
$order = get_user_last_order($user);
require '../../private/php/getapikey.php';

if ($order && user_last_order_unpaid($user)) {
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
      $path = __DIR__ . "/../../private/data/orders.json";
      if (!file_exists($path)) return;
      $content = file_get_contents($path);
      $orders = json_decode($content, true);

      foreach ($orders as &$o) {
          if ($o['id'] == $orderId) {
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
                  $o['paymentStatus'] = 'success';
              } else {
                  $message = "Payment failed";
                  $o['paymentStatus'] = 'failed';
              }

              break;
          }
      }
      file_put_contents($path, json_encode($orders, JSON_PRETTY_PRINT));
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
</head>
<body>

  <?php include 'header.html'; ?>

  <?php include 'sidebar.php'; ?>

  <main>
    <section class="infos">
        <h2>Payment</h2>
        <article class="modernNeonBoxGlass">
            <?php if ($isReturn): ?>
                <h3><?= htmlspecialchars($message ?? "Payment processed") ?></h3>
                <a href="cart.php">Back to cart</a>
            <?php elseif (!user_last_order_unpaid($user)): ?>
                <h3>You have no unpaid order.</h3>
                <a href="cart.php">Back to cart</a>
            <?php else: ?>
            <form method="post" action="https://www.plateforme-smc.fr/cybank/">
                <fieldset>
                    <h1>Confirm your payment</h1>
                    <input type="hidden" name="transaction" value="<?= htmlspecialchars($transaction) ?>">
                    <input type="hidden" name="montant" value="<?= htmlspecialchars($amount) ?>">
                    <input type="hidden" name="vendeur" value="<?= htmlspecialchars($vendor) ?>">
                    <input type="hidden" name="retour" value="<?= htmlspecialchars($return) ?>">
                    <input type="hidden" name="control" value="<?= htmlspecialchars($control) ?>">

                    <div class="field buttons">
                        <div>
                            <label>Proceed to payment</label>
                            <button type="submit" class="button">Pay now</button>
                        </div>
                    </div>

                    <?php
                        if ($error!='') echo '<p class="error-message">' . htmlspecialchars($error) . '</p>';
                    ?>
                </fieldset>
            </form>
            <?php endif; ?>
        </article>
    </section>
  </main>

  <?php include 'footer.html'; ?>
</body>
</html>
