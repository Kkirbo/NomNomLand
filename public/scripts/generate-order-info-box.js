import { getUserId } from "../scripts/get-user-id.js";
import { getOrderInfo } from "../scripts/get-order-info.js";
import { getItemInfo } from "../scripts/get-item-info.js";

export async function getLastOrderInfo() {
    let userId = await getUserId();
    if (!userId || userId.status != 200 || !userId.id) {
        return;
    }
    userId = userId.id;
    return getOrderInfo("user", userId);
}

export async function generateOrderInfoBox(orderInfo, showRatingLink=false) {
    const box = document.createElement("article");
    box.className = "order-info-box";

    const items = orderInfo.content?.join(", ") || "No items";
    const itemCounts = {};
    for (const item of orderInfo.content || []) {
        itemCounts[item] = (itemCounts[item] || 0) + 1;
    }
    
    let newHTML = `<h3>Latest Order: #${orderInfo.id}</h3>`;
    for (const itemId in itemCounts) {
        let itemInfo = await getItemInfo(itemId);
        if (!itemInfo) continue;
        itemInfo = itemInfo.data;

        itemInfo.quantity = itemCounts[itemId];
        newHTML += `
            <div class="order-preview">
                <img src="${itemInfo.image}" alt="${itemInfo.title}">
                <div class="infos">
                    <span class="title">${itemInfo.title}</span>
                    <span class="meta">${itemInfo.version ?? itemInfo.description[0] ?? "version 1.0"}</span>
                    <span class="price">x${itemInfo.quantity} • ${itemInfo.price}€</span>
                </div>
            </div>
        `;   
    }
    newHTML += `
        <div>
            <p><strong>User ID:</strong> ${orderInfo.user_id}</p>
            <p><strong>Phone:</strong> ${orderInfo.phone}</p>
            
            <p><strong>Price:</strong> $${orderInfo.price}</p>
            <p><strong>Payment:</strong> ${orderInfo.paymentStatus}</p>
            
            <p><strong>Delivery Status:</strong> ${orderInfo.delivery.status}</p>
            <p><strong>Address:</strong> ${orderInfo.delivery.address || "N/A"}</p>
        </div>

        <p><strong>Date:</strong> ${orderInfo.date}</p>

        ${showRatingLink ? '<a href="rating.php">Rate this order</a>' : ''}
    `;
    box.innerHTML = newHTML;
    return box;
}