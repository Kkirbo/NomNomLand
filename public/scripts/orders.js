import { requestOrderUpdate } from "./request-order-update.js";

function renderActions(status, orderId) {

    switch(status) {

        case 'pending':
            return `
                <button
                    class="update-order-btn"
                    data-order-id="${orderId}"
                    data-field="delivery->status"
                    data-value="preparing"
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
                >
                Put command as ready
                </button>
            `;
            
        case 'ready':
            return `
                <select class="delivery-person-select">
                    ${renderDeliveryPeopleOptions()}
                </select>

                <button
                    class="update-order-btn"
                    data-order-id="${orderId}"
                    data-field="delivery->status"
                    data-value="delivery"
                >
                    Send to Delivery
                </button>
            `;

        default:
            return `<p>No actions available</p>`;
    }
}

function renderDeliveryPeopleOptions() {    

    return deliveryPeople.map(person => `
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

    const delivery_status_updated = await requestOrderUpdate(orderId, field, value);
    console.log(delivery_status_updated);
    
    if (!delivery_status_updated || delivery_status_updated.status != 200) {
        return;
    }

    const actionsContainer = button.closest('.order-actions');

    if (value == "delivery") {
        const select = actionsContainer.querySelector('.delivery-person-select');
        const deliveryPersonId = select.value;
        const deliveryPersonName = select.options[select.selectedIndex].text;

        const delivery_person_updated = await requestOrderUpdate(orderId, "delivery->delivery_person_id", deliveryPersonId);
        console.log(delivery_person_updated);

        if (!delivery_person_updated || delivery_person_updated.status != 200) {
            return;
        }

        const modalContent = button.closest('.modalContent');
        const deliveryPersonElement = modalContent.querySelector('.delivery-person-name');
        deliveryPersonElement.textContent = deliveryPersonName;

    }

    actionsContainer.innerHTML = renderActions(value, orderId);
});
