import "./display-latest-order.js";

import { requestOrderUpdate } from "./request-order-update.js";

async function refreshOrderPreview() {
const res = await fetch("../api/get-latest-command.php");
    const data = await res.json();
    if (!data.success) return;
    const container = document.getElementById("order-container");
    if (!container) return;
    let html = "";
    for (const dish of data.dishes) {
    html += `
        <div class="order-preview">
            <img src="${dish.image}" alt="${dish.title}">
            <div class="infos">
                <span class="title">${dish.title}</span>
                <span class="meta">${dish.version}</span>
                <span class="price">x${dish.quantity} • ${dish.price}€</span>
            </div>
        </div>
    `;
}
    container.innerHTML = html;
}
setInterval(refreshOrderPreview, 3000);
refreshOrderPreview();


function initRatingForm() {

    const form = document.getElementById("rating-form");

    if (!form) return;

    form.addEventListener("submit", async function (e) {

        console.log(lastOrder);
        

        e.preventDefault();

        const questions = ["q1", "q2", "q3", "q4", "q5"];

        const rating = {};

        questions.forEach(q => {

            const checked = document.querySelector(
                `input[name="rating-${q}"]:checked`
            );

            rating[q] = checked
                ? parseInt(checked.value)
                : null;
        });

        console.log(rating);

        console.log(lastOrder);
        const orderId = lastOrder["id"];

        const delivery_status_updated = await requestOrderUpdate(
            encodeURIComponent(orderId), 
            encodeURIComponent("rating"), 
            encodeURIComponent(JSON.stringify(rating))
        );
        console.log(delivery_status_updated.status);

        const form = document.getElementById("rating-form-wrapper");

        form.innerHTML = `
            <div>
                <h3>Merci pour votre retour !</h3>
            </div>
        `;
        
        if (!delivery_status_updated || delivery_status_updated.status != 200) {
            return;
        }

    });
}

initRatingForm();