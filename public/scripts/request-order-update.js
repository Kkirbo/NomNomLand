export async function requestOrderUpdate(orderId, field, value) {
  try {
    const response = await fetch(`../api/request-order-update.php?orderId=${orderId}&field=${field}&value=${value}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return false;
  }
}