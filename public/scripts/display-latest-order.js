import { getLastOrderInfo, generateOrderInfoBox } from "../scripts/generate-order-info-box.js";

const ordersBox = document.querySelector('.ordersContainer');
(async function() {
  if (!ordersBox) return;
  const lastOrderInfo = await getLastOrderInfo();
  if (!lastOrderInfo || lastOrderInfo.status != 200) return;
  const orderInfoBox = await generateOrderInfoBox(lastOrderInfo.data, true);
  ordersBox.replaceChildren(orderInfoBox);
})();