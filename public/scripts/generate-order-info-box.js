import { getItemInfo } from "../scripts/get-item-info.js";

export async function generateOrderInfoBox(orderInfo, showRatingLink=false) {
    //const items = orderInfo?.content?.join(", ") || "No items";
    const itemCounts = {};
    for (const item of orderInfo?.content || []) {
        itemCounts[item] = (itemCounts[item] || 0) + 1;
    }
    
    let newHTML = `
        <h3>#${orderInfo?.id ?? "N/A"}</h3>
        <div class="orderItemsContainer">
    `;
    for (const itemId in itemCounts) {
        let itemInfo = await getItemInfo(itemId);
        if (!itemInfo) continue;
        itemInfo = itemInfo.data;

        itemInfo.quantity = itemCounts[itemId];
        newHTML += `
            <div class="order-preview modernNeonBoxGlass">
                <img src="${itemInfo.image}" alt="${itemInfo.title}">
                <div class="infos">
                    <span class="title">${itemInfo.title}</span>
                    <span class="meta">${"No options"}</span>
                    <span class="price">x${itemInfo.quantity} • ${itemInfo.price}€</span>
                </div>
            </div>
        `;
    }
    newHTML += `
        </div>
        <div class="details">
            <p><strong>User ID:</strong> ${orderInfo?.user_id ?? "N/A"}</p>
            <p><strong>Phone:</strong> ${orderInfo?.phone ?? "N/A"}</p>
            
            <p><strong>Price:</strong> $${orderInfo?.price ?? 0}</p>
            <p><strong>Payment:</strong> ${orderInfo?.paymentStatus ?? "N/A"}</p>
            
            <p><strong>Delivery Status:</strong> ${orderInfo?.delivery.status ?? "N/A"}</p>
            <p><strong>Address:</strong> ${orderInfo?.delivery?.address ?? "N/A"}</p>
        </div>

        <p><strong>Date:</strong> ${orderInfo?.date ?? "N/A"}</p>

        ${showRatingLink ? '<a href="rating.php">Rate this order</a>' : ''}
    `;
    return newHTML;
}