import { getUserId } from "../scripts/get-user-id.js";

export async function getOrderInfo(type, id) {
  try {
    const response = await fetch(`../api/fetch-order-info.php?type=${type}&id=${id}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return null;
  }
}

export async function getLastOrderInfo() {
    let userId = await getUserId();
    if (!userId || userId.status != 200 || !userId.id) {
        return;
    }
    userId = userId.id;
    return getOrderInfo("user", userId);
}