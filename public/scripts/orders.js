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

    const updated = await requestOrderUpdate(orderId, field, value);
    console.log(updated);
    
    if (!updated || updated.status != 200) {
        return;
    }
    const actionsContainer = button.closest('.order-actions');
    actionsContainer.innerHTML = renderActions(value, orderId);
});