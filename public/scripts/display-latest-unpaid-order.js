import { getLastOrderInfo } from "../scripts/get-order-info.js";
import { generateOrderInfoBox } from "../scripts/generate-order-info-box.js";

const ordersBox = document.querySelector('.ordersContainer');
(async function() {
  if (!ordersBox) return;
  const lastOrderInfo = await getLastOrderInfo();
  if (!lastOrderInfo || lastOrderInfo.status != 200) return;
  const orderInfoHTML = await generateOrderInfoBox(lastOrderInfo.data, false);
  ordersBox.innerHTML = orderInfoHTML;
})();