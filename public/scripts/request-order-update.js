export async function requestOrderUpdate(orderId, field, value) {
  try {
    const query = new URLSearchParams({ userId, field, value });
    const response = await fetch(`../api/request-order-update.php?${query}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return false;
  }
}