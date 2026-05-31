import { requestOrderUpdate } from "../scripts/request-order-update.js";
import { getOrderInfo } from "../scripts/get-order-info.js";
import { generateOrderInfoBox } from "../scripts/generate-order-info-box.js";

function renderActions(status, isRestaurant, orderId) {

    switch(status) {

        case 'pending':
            return `
                <button
                    class="update-order-btn"
                    data-order-id="${orderId}"
                    data-field="delivery->status"
                    data-value="preparing"
                    data-is-restaurant="${isRestaurant}"
                >
                    Prepare command
                </button>
            `;
            
        case 'preparing':
            return `
                <button
                class="update-order-btn"
                data-order-id="${orderId}"
                data-field="delivery->status"
                data-value="ready"
                data-is-restaurant="${isRestaurant}"
                >
                Put command as ready
                </button>
            `;
            
        case 'ready':

            if (!isRestaurant) {
                return `
                    <select class="delivery-person-select">
                        ${renderDeliveryPeopleOptions()}
                    </select>

                    <button
                        class="update-order-btn"
                        data-order-id="${orderId}"
                        data-field="delivery->status"
                        data-value="delivery"
                        data-is-restaurant="${isRestaurant}"
                    >
                        Send to Delivery
                    </button>
                `;
            } else {
                return `
                    <button
                        class="update-order-btn"
                        data-order-id="${orderId}"
                        data-field="delivery->status"
                        data-value="success"
                        data-is-restaurant="${isRestaurant}"
                    >
                        Send to a waiter.
                    </button>
                `;
            }


        default:
            return `<p>No actions available</p>`;
    }
}

function renderDeliveryPeopleOptions() {
    return avaiableDeliveryPeople.map(person => `
        <option value="${person.id}">
            ${person.profile.firstName} ${person.profile.lastName}
        </option>
    `).join('');
}

document.addEventListener('click', async (e) => {

    const button = e.target;

    if (!button.classList.contains('update-order-btn')) {
        return;
    }

    const orderId = button.dataset.orderId;
    const field = button.dataset.field;
    const value = button.dataset.value;
    const isRestaurant = button.dataset.isRestaurant
    

    const delivery_status_updated = await requestOrderUpdate(orderId, field, value);
    
    if (!delivery_status_updated || delivery_status_updated.status != 200) {
        return;
    }

    const actionsContainer = button.closest('.order-actions');

    if (value == "delivery") {
        const select = actionsContainer.querySelector('.delivery-person-select');
        const deliveryPersonId = select.value;
        const deliveryPersonName = select.options[select.selectedIndex].text;

        const delivery_person_updated = await requestOrderUpdate(orderId, "delivery->delivery_person_id", deliveryPersonId);

        if (!delivery_person_updated || delivery_person_updated.status != 200) {
            return;
        }

        const modalContent = button.closest('.modalContent');

    }

    actionsContainer.innerHTML = renderActions(value, isRestaurant, orderId);
});

let orderInfoBoxes = document.querySelectorAll("div.ordersContainer");
(async () => {
    for (const orderInfoBox of orderInfoBoxes) {
        let orderInfo = await getOrderInfo("order", orderInfoBox.dataset.id);
        orderInfoBox.innerHTML = await generateOrderInfoBox(orderInfo.data);
    }
})();
