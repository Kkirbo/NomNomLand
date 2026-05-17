import { requestOrderUpdate } from "./request-order-update.js";

async function updateDeliveryStatus(status) {
    
    try {
      await requestOrderUpdate(
        window.orderId,
        "delivery->status",
        status
      );

      window.location.reload();

    } catch (error) {
      console.error("Error delivery update :", error);
    }
  }

document
.getElementById("delivery-complete")
.addEventListener("click", () => {
    updateDeliveryStatus("success");
});

document
.getElementById("delivery-giveup")
.addEventListener("click", () => {
    updateDeliveryStatus("failed");
});