export async function getOrderInfo(type, id) {
  try {
    const response = await fetch(`../api/fetch-order-info.php?type=${type}&id=${id}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return null;
  }
}