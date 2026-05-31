import { getLastPaidOrderInfo } from "../scripts/get-order-info.js";
import { generateOrderInfoBox } from "../scripts/generate-order-info-box.js";

const ordersBox = document.querySelector('.ordersContainer.latestOrder');
(async function() {
  if (!ordersBox) return;
  const lastOrderInfo = await getLastPaidOrderInfo();
  if (!lastOrderInfo || lastOrderInfo.status != 200) return;
  const orderInfoHTML = await generateOrderInfoBox(lastOrderInfo.data, true);
  ordersBox.innerHTML = orderInfoHTML;
})();