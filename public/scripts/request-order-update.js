export async function requestOrderUpdate(orderId, field, value) {
  try {
    const query = new URLSearchParams({ orderId, field, value });
    const response = await fetch(`../api/request-order-update.php?${query}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return false;
  }
}

export async function sendCartToOrder(options={}, deliveryMode="delivery") {
  try {
    const response = await fetch(`../api/request-send-cart-to-order.php?options=${encodeURIComponent(JSON.stringify(options))}&deliveryMode=${deliveryMode}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return null;
  }
}