import { getUserId } from "../scripts/get-user-id.js";
import { getOrderInfo } from "../scripts/get-order-info.js";

export async function getLastOrderInfo() {
    let userId = await getUserId();
    if (!userId || userId.status != 200 || !userId.id) {
        return;
    }
    userId = userId.id;
    return getOrderInfo("user", userId);
}

export function generateOrderInfoBox(orderInfo) {
    console.log(orderInfo);
}