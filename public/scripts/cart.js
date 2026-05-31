import { getItemInfo } from "../scripts/get-item-info.js";
import { sendUserNotification } from "./utilities/message.js";
import { sendCartToOrder } from "./request-order-update.js";

export async function addArticleToCart(form) {
  const formData = new FormData(form);
  try {
    const GET_PARAMS_FROM_FORM = new URLSearchParams(formData);
    const response = await fetch(`../api/request-add-to-cart.php?${GET_PARAMS_FROM_FORM}`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return null;
  }
}

export async function getCartInfo() {
  try {
    const response = await fetch(`../api/fetch-cart-info.php`);
    return await response.json();
  } catch (e) {
    console.error(e);
    return null;
  }
}

export async function generateCartInfoBox(cartInfo, showRatingLink=false) {
    let newHTML = `
        <div class="orderItemsContainer">
    `;
    for (const item of cartInfo?.contents) {
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
    `;
    return newHTML;
}

/**
 * Load and display Cart data
 */
const priceTotalSpan = document.querySelector('article.cartContainer h3>span.price');
const ordersBox = document.querySelector('.ordersContainer.cart');
const placeOrderButton = document.querySelector('article.cartContainer button.placeOrder');
(async function() {
  if (!ordersBox) return;
  const cartInfo = await getCartInfo();
  if (!cartInfo || cartInfo.status != 200 || cartInfo.data.total <= 0) return;
  if (priceTotalSpan) priceTotalSpan.textContent = `${cartInfo.data.total}€ (Fidelity discount: ${cartInfo.data.discount}€)`;
  placeOrderButton.classList.remove("hidden");
  const cartInfoHTML = await generateCartInfoBox(cartInfo.data, true);
  ordersBox.innerHTML = cartInfoHTML;
})();

/**
 * Place order modal
 */
const sidebarCheckbox = document.querySelector('#togglesidebar');
const backgroundBlurModal = document.querySelector('.background-blur.modal');
if (placeOrderButton) placeOrderButton.addEventListener("click", (e) => {
  backgroundBlurModal.classList.add("active");
});

export function closeModal() {
    backgroundBlurModal.classList.remove("active");
}

//Hide modal when clicking outside
backgroundBlurModal.addEventListener("click", (e) => {
    if (backgroundBlurModal.children[0].contains(e.target)) return;
    closeModal();
});

//Escape key to close modal
document.addEventListener("keydown", (e) => {
  if (e.keyCode === 27) {
    if (sidebarCheckbox && backgroundBlurModal.classList.contains("active")) setTimeout(() => sidebarCheckbox.checked = !sidebarCheckbox.checked, 1);
    closeModal();
  }
});

/**
 * Place order
 */
const sendToDeliveryButton = backgroundBlurModal.querySelector('.modalContent button.placeOrder');
const optionsForm = backgroundBlurModal.querySelector('.modalContent form.options');
if (optionsForm) optionsForm.addEventListener("submit", (e) => e.preventDefault());

if (sendToDeliveryButton) sendToDeliveryButton.addEventListener("click", async (e) => {
  const options = {
    salt: optionsForm.elements.salt.checked,
    fries: optionsForm.elements.fries.checked,
    priority: optionsForm.elements.priority.checked,
    tip: Number(optionsForm.elements.tip.value || 0)
  };
  let request = await sendCartToOrder(options, "delivery");
  if (!request || request.status != 200) {
    sendUserNotification(request.error ?? "Failed to add item to cart", 5, true);
    return;
  }
  window.location.href = "payment.php";
  //sendUserNotification(`<span>Your order was placed:</span><span><a href="orders.php">View my Orders</a></span>`, 5);
});