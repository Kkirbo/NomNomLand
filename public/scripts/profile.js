import { getOrderInfo } from "../scripts/get-order-info.js";
import { getUserId } from "../scripts/get-user-id.js";
import { generateOrderInfoBox } from "../scripts/generate-order-info-box.js";

const ordersBox = document.querySelector('article.orders');
let userId = await getUserId();
(async function() {
  if (!userId || userId.status != 200 || !userId.id) {
    return;
  }
  userId = userId.id;
  const lastOrderInfo = await getOrderInfo("user", userId);
  const orderInfoBox = generateOrderInfoBox(lastOrderInfo);
  if (typeof orderInfoBox == typeof 1) {
    
  }
})();


document.addEventListener("click", async (e) => {
  // CLICK SUR EDIT
  if (e.target.classList.contains("edit-btn")) {
    const row = e.target.closest(".info-row");
    const valueSpan = row.querySelector(".value");
    const field = row.dataset.field;

    const currentValue = valueSpan.childNodes[0].textContent.trim();

    valueSpan.innerHTML = `
      <input type="text" value="${currentValue}" />
      <button class="save-btn">💾</button>
      <button class="cancel-btn">❌</button>
    `;
  }

  // CLICK SUR SAVE
  if (e.target.classList.contains("save-btn")) {
    const row = e.target.closest(".info-row");
    const valueSpan = row.querySelector(".value");
    const field = row.dataset.field;
    const input = valueSpan.querySelector("input");

    const newValue = input.value;

    const res = await fetch("../../private/php/update_profile.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ field, value: newValue })
    });

    const data = await res.json();

    if (data.success) {
      valueSpan.innerHTML = `
        ${newValue}
        <button class="edit-btn">✏️</button>
      `;
    }
  }

  // CLICK SUR CANCEL
  if (e.target.classList.contains("cancel-btn")) {
    const row = e.target.closest(".info-row");
    const valueSpan = row.querySelector(".value");
    const original = valueSpan.querySelector("input").defaultValue;

    valueSpan.innerHTML = `
      ${original}
      <button class="edit-btn">✏️</button>
    `;
  }
});