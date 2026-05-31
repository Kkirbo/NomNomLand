import { getItemInfo } from "../scripts/get-item-info.js";

export async function generateOrderInfoBox(orderInfo, showRatingLink=false) {
    let newHTML = `
        <h3>#${orderInfo?.id ?? "N/A"} (${orderInfo?.price ?? 0}€)</h3>
        <div class="orderItemsContainer">
    `;
    for (const item of orderInfo?.contents) {
        console.log(item);
        let itemInfo = await getItemInfo(item.id);
        if (!itemInfo || itemInfo.status != 200 || !itemInfo.data) continue;
        itemInfo = itemInfo.data;

        newHTML += `
            <div class="order-preview modernNeonBoxGlass">
                <img src="${itemInfo.image}" alt="${itemInfo.title}">
                <div class="infos">
                    <span class="title">${itemInfo.title}</span>
        `;
        if (item.contents) for (const dish of item.contents) {
            let dishInfo = await getItemInfo(dish);
            if (!dishInfo || dishInfo.status != 200 || !dishInfo.data) continue;
            newHTML += `
                <span class="meta">${dishInfo.data.title ?? dish}</span>
            `;
        } 
        else newHTML += `<span class="meta">${"No options"}</span>`;
        newHTML += `
                    <span class="price">x${item.quantity} • ${itemInfo.price}€</span>
                </div>
            </div>
        `;
    }
    newHTML += `
        </div>
        <div class="details">
            <p><strong>User ID:</strong> ${orderInfo?.user_id ?? "N/A"}</p>
            <p><strong>Phone:</strong> ${orderInfo?.phone ?? "N/A"}</p>
            
            <p><strong>Price:</strong> ${orderInfo?.price ?? 0}€</p>
            <p><strong>Payment:</strong> ${orderInfo?.paymentStatus ?? "N/A"}</p>
            
            <p><strong>Delivery Status:</strong> ${orderInfo?.delivery.status ?? "N/A"}</p>
            <p><strong>Address:</strong> ${orderInfo?.delivery?.address ?? "N/A"}</p>
        </div>

        <p><strong>Date:</strong> ${orderInfo?.date ?? "N/A"}</p>

        ${showRatingLink ? '<a href="rating.php">Rate this order</a>' : ''}
    `;
    return newHTML;
}