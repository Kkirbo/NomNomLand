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
    const box = document.createElement("article");
    box.className = "order-info-box";

    const items = orderInfo.content?.join(", ") || "No items";

    box.innerHTML = `
        <h3>Order #${orderInfo.id}</h3>
        
        <p><strong>User ID:</strong> ${orderInfo.user_id}</p>
        <p><strong>Phone:</strong> ${orderInfo.phone}</p>
        
        <p><strong>Items:</strong> ${items}</p>
        
        <p><strong>Price:</strong> $${orderInfo.price}</p>
        <p><strong>Payment:</strong> ${orderInfo.paymentStatus}</p>
        
        <p><strong>Delivery Status:</strong> ${orderInfo.delivery.status}</p>
        <p><strong>Address:</strong> ${orderInfo.delivery.address || "N/A"}</p>
        
        <p><strong>Date:</strong> ${orderInfo.date}</p>
        <a href="rating.php">Rate this order</a>
    `;

    return box;
}